/**
 * Carousel galeri foto — vanilla JS, tanpa library eksternal.
 */
(function () {
    const section = document.querySelector('[data-food-gallery]');
    if (!section) {
        return;
    }

    const track = section.querySelector('[data-gallery-track]');
    const viewport = section.querySelector('[data-gallery-viewport]');
    const prevBtn = section.querySelector('[data-gallery-prev]');
    const nextBtn = section.querySelector('[data-gallery-next]');
    const emptyEl = section.querySelector('[data-gallery-empty]');
    const lightbox = section.querySelector('[data-gallery-lightbox]');
    const lightboxImg = section.querySelector('[data-gallery-lightbox-img]');
    const lightboxCaption = section.querySelector('[data-gallery-lightbox-caption]');

    let items = [];
    let suppressLightboxClick = false;
    let index = 0;
    let perView = 3;
    let gap = 20;
    let cardWidth = 380;
    let autoplayTimer = null;
    let isPaused = false;
    let isDragging = false;
    let dragStartX = 0;
    let dragDelta = 0;
    let transitionEnabled = true;

    function getPerView() {
        if (window.innerWidth < 640) {
            return 1;
        }
        if (window.innerWidth < 1024) {
            return 2;
        }
        return 3;
    }

    function measure() {
        perView = getPerView();
        const viewportWidth = viewport.clientWidth;
        gap = perView === 1 ? 16 : 20;
        cardWidth = Math.floor((viewportWidth - gap * (perView - 1)) / perView);
        cardWidth = Math.min(380, Math.max(260, cardWidth));
        section.style.setProperty('--gallery-card-w', cardWidth + 'px');
        section.style.setProperty('--gallery-card-h', '280px');
        section.style.setProperty('--gallery-gap', gap + 'px');
    }

    function loadItems() {
        const raw = section.getAttribute('data-gallery-photos');
        if (!raw) {
            return [];
        }
        try {
            const parsed = JSON.parse(raw);
            if (!Array.isArray(parsed)) {
                return [];
            }
            return parsed.map(function (item) {
                return {
                    name: item.name,
                    base64Image: item.imageUrl,
                    uploadedAt: item.uploadedAt,
                };
            });
        } catch (e) {
            return [];
        }
    }

    function render() {
        items = loadItems();
        track.innerHTML = '';

        if (items.length === 0) {
            emptyEl.hidden = false;
            viewport.hidden = true;
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            return;
        }

        emptyEl.hidden = true;
        viewport.hidden = false;
        prevBtn.disabled = false;
        nextBtn.disabled = false;

        items.forEach((item) => {
            const slide = document.createElement('article');
            slide.className = 'food-gallery__card';
            slide.innerHTML =
                '<div class="food-gallery__card-inner">' +
                '<img src="' + item.base64Image + '" alt="' + escapeHtml(item.name) + '" loading="lazy" draggable="false">' +
                '<div class="food-gallery__card-overlay"><span>' + escapeHtml(item.name) + '</span></div>' +
                '</div>';
            track.appendChild(slide);
        });

        track.querySelectorAll('.food-gallery__card').forEach(function (card, cardIndex) {
            card.addEventListener('click', function () {
                if (suppressLightboxClick) {
                    return;
                }
                const item = items[cardIndex];
                if (item) {
                    openLightbox(item);
                }
            });
        });

        index = Math.min(index, Math.max(0, items.length - 1));
        goTo(index, false);
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function openLightbox(item) {
        if (!lightbox || !lightboxImg) {
            return;
        }
        lightboxImg.src = item.base64Image;
        lightboxImg.alt = item.name;
        lightboxCaption.textContent = item.name;
        lightbox.hidden = false;
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (!lightbox) {
            return;
        }
        lightbox.hidden = true;
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.removeAttribute('src');
        document.body.style.overflow = '';
    }

    section.querySelectorAll('[data-gallery-lightbox-close]').forEach(function (el) {
        el.addEventListener('click', closeLightbox);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightbox && !lightbox.hidden) {
            closeLightbox();
        }
    });

    function offsetForIndex(i) {
        return -(i * (cardWidth + gap));
    }

    function goTo(i, animate) {
        if (items.length === 0) {
            return;
        }

        if (i < 0) {
            i = items.length - 1;
        }
        if (i >= items.length) {
            i = 0;
        }

        index = i;
        transitionEnabled = animate;
        track.style.transition = animate ? 'transform 400ms ease-in-out' : 'none';
        track.style.transform = 'translateX(' + offsetForIndex(index) + 'px)';
    }

    function next() {
        goTo(index + 1, true);
    }

    function prev() {
        goTo(index - 1, true);
    }

    function startAutoplay() {
        stopAutoplay();
        autoplayTimer = setInterval(function () {
            if (!isPaused && !isDragging && items.length > 1) {
                next();
            }
        }, 4000);
    }

    function stopAutoplay() {
        if (autoplayTimer) {
            clearInterval(autoplayTimer);
            autoplayTimer = null;
        }
    }

    function snapAfterDrag() {
        const threshold = cardWidth * 0.25;
        if (dragDelta < -threshold) {
            next();
        } else if (dragDelta > threshold) {
            prev();
        } else {
            goTo(index, true);
        }
        dragDelta = 0;
    }

    function onPointerDown(clientX) {
        if (items.length <= 1) {
            return;
        }
        isDragging = true;
        isPaused = true;
        dragStartX = clientX;
        dragDelta = 0;
        track.style.transition = 'none';
    }

    function onPointerMove(clientX) {
        if (!isDragging) {
            return;
        }
        dragDelta = clientX - dragStartX;
        track.style.transform = 'translateX(' + (offsetForIndex(index) + dragDelta) + 'px)';
    }

    function onPointerUp() {
        if (!isDragging) {
            return;
        }
        if (Math.abs(dragDelta) > 8) {
            suppressLightboxClick = true;
            setTimeout(function () {
                suppressLightboxClick = false;
            }, 320);
        }
        isDragging = false;
        isPaused = false;
        snapAfterDrag();
    }

    prevBtn.addEventListener('click', function () {
        prev();
        startAutoplay();
    });

    nextBtn.addEventListener('click', function () {
        next();
        startAutoplay();
    });

    viewport.addEventListener('mouseenter', function () {
        isPaused = true;
    });
    viewport.addEventListener('mouseleave', function () {
        if (!isDragging) {
            isPaused = false;
        }
    });

    viewport.addEventListener('mousedown', function (e) {
        e.preventDefault();
        onPointerDown(e.clientX);
    });
    window.addEventListener('mousemove', function (e) {
        onPointerMove(e.clientX);
    });
    window.addEventListener('mouseup', onPointerUp);

    viewport.addEventListener('touchstart', function (e) {
        onPointerDown(e.touches[0].clientX);
    }, { passive: true });
    viewport.addEventListener('touchmove', function (e) {
        onPointerMove(e.touches[0].clientX);
    }, { passive: true });
    viewport.addEventListener('touchend', onPointerUp);

    window.addEventListener('resize', function () {
        measure();
        goTo(index, false);
    });

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    section.classList.add('is-visible');
                    observer.disconnect();
                }
            });
        },
        { threshold: 0.15 }
    );
    observer.observe(section);

    measure();
    render();
    startAutoplay();
})();
