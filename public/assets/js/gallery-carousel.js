/**
 * Carousel galeri foto + modal lightbox — vanilla JS.
 */
(function () {
    function initGallery() {
        const section = document.querySelector('[data-food-gallery]');
        if (!section) {
            return;
        }

        section.classList.add('is-visible');

        const track = section.querySelector('[data-gallery-track]');
        const viewport = section.querySelector('[data-gallery-viewport]');
        const prevBtn = section.querySelector('[data-gallery-prev]');
        const nextBtn = section.querySelector('[data-gallery-next]');
        const lightbox = section.querySelector('[data-gallery-lightbox]');
        const lightboxImg = section.querySelector('[data-gallery-lightbox-img]');
        const lightboxCaption = section.querySelector('[data-gallery-lightbox-caption]');
        const lightboxPrev = section.querySelector('[data-gallery-lightbox-prev]');
        const lightboxNext = section.querySelector('[data-gallery-lightbox-next]');

        let items = [];
        let index = 0;
        let modalIndex = 0;
        let perView = 3;
        let gap = 20;
        let cardWidth = 380;
        let maxIndex = 0;
        let autoplayTimer = null;
        let isPaused = false;
        let isDragging = false;
        let dragStartX = 0;
        let dragDelta = 0;
        let suppressClick = false;

        function getPerView() {
            if (window.innerWidth < 640) {
                return 1;
            }
            if (window.innerWidth < 1024) {
                return 2;
            }
            return 3;
        }

        function loadItemsFromDom() {
            if (!track) {
                return [];
            }

            return Array.from(track.querySelectorAll('.food-gallery__card')).map(function (card) {
                const img = card.querySelector('img');
                return {
                    name: img ? img.alt : '',
                    imageUrl: img ? img.currentSrc || img.src : '',
                };
            });
        }

        function updateBounds() {
            maxIndex = Math.max(0, items.length - perView);
            if (index > maxIndex) {
                index = maxIndex;
            }
        }

        function measure() {
            if (!viewport) {
                return;
            }

            perView = getPerView();
            const viewportWidth = viewport.clientWidth || viewport.offsetWidth;
            gap = perView === 1 ? 16 : 20;
            cardWidth = Math.floor((viewportWidth - gap * (perView - 1)) / perView);
            cardWidth = Math.min(380, Math.max(220, cardWidth));
            section.style.setProperty('--gallery-card-w', cardWidth + 'px');
            section.style.setProperty('--gallery-card-h', '280px');
            section.style.setProperty('--gallery-gap', gap + 'px');
            updateBounds();
        }

        function offsetForIndex(i) {
            return -(i * (cardWidth + gap));
        }

        function goTo(i, animate) {
            if (!track || items.length === 0) {
                return;
            }

            if (items.length <= perView) {
                index = 0;
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                updateNavButtons();
                return;
            }

            if (i < 0) {
                i = maxIndex;
            }
            if (i > maxIndex) {
                i = 0;
            }

            index = i;
            track.style.transition = animate ? 'transform 400ms ease-in-out' : 'none';
            track.style.transform = 'translateX(' + offsetForIndex(index) + 'px)';
            updateNavButtons();
        }

        function updateNavButtons() {
            const canScroll = items.length > perView;
            if (prevBtn) {
                prevBtn.disabled = !canScroll;
            }
            if (nextBtn) {
                nextBtn.disabled = !canScroll;
            }
        }

        function next() {
            goTo(index >= maxIndex ? 0 : index + 1, true);
        }

        function prev() {
            goTo(index <= 0 ? maxIndex : index - 1, true);
        }

        function openLightbox(itemIndex) {
            if (!lightbox || !lightboxImg || !items.length) {
                return;
            }

            modalIndex = itemIndex;
            if (modalIndex < 0) {
                modalIndex = 0;
            }
            if (modalIndex >= items.length) {
                modalIndex = items.length - 1;
            }

            const item = items[modalIndex];
            lightboxImg.src = item.imageUrl;
            lightboxImg.alt = item.name;
            if (lightboxCaption) {
                lightboxCaption.textContent = item.name;
            }

            lightbox.hidden = false;
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('gallery-modal-open');
            document.body.style.overflow = 'hidden';

            const showNav = items.length > 1;
            if (lightboxPrev) {
                lightboxPrev.hidden = !showNav;
            }
            if (lightboxNext) {
                lightboxNext.hidden = !showNav;
            }
        }

        function closeLightbox() {
            if (!lightbox) {
                return;
            }

            lightbox.hidden = true;
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('gallery-modal-open');
            document.body.style.overflow = '';

            if (lightboxImg) {
                lightboxImg.removeAttribute('src');
            }
        }

        function modalPrev() {
            if (!items.length) {
                return;
            }
            modalIndex = modalIndex <= 0 ? items.length - 1 : modalIndex - 1;
            openLightbox(modalIndex);
        }

        function modalNext() {
            if (!items.length) {
                return;
            }
            modalIndex = modalIndex >= items.length - 1 ? 0 : modalIndex + 1;
            openLightbox(modalIndex);
        }

        function startAutoplay() {
            stopAutoplay();
            if (items.length <= perView) {
                return;
            }
            autoplayTimer = setInterval(function () {
                if (!isPaused && !isDragging) {
                    next();
                }
            }, 4500);
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        function snapAfterDrag() {
            const threshold = Math.min(60, cardWidth * 0.2);
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
            if (items.length <= perView) {
                return;
            }
            isDragging = true;
            isPaused = true;
            dragStartX = clientX;
            dragDelta = 0;
            if (track) {
                track.style.transition = 'none';
            }
        }

        function onPointerMove(clientX) {
            if (!isDragging || !track) {
                return;
            }
            dragDelta = clientX - dragStartX;
            track.style.transform = 'translateX(' + (offsetForIndex(index) + dragDelta) + 'px)';
        }

        function onPointerUp() {
            if (!isDragging) {
                return;
            }

            if (Math.abs(dragDelta) > 10) {
                suppressClick = true;
                setTimeout(function () {
                    suppressClick = false;
                }, 300);
            }

            isDragging = false;
            isPaused = false;
            snapAfterDrag();
        }

        function setup() {
            items = loadItemsFromDom();
            if (!track || !viewport || !prevBtn || !nextBtn || items.length === 0) {
                return;
            }

            measure();
            goTo(0, false);

            prevBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                prev();
                startAutoplay();
            });

            nextBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                next();
                startAutoplay();
            });

            function openCardModal(card) {
                const cards = Array.from(track.querySelectorAll('.food-gallery__card'));
                const cardIndex = cards.indexOf(card);
                if (cardIndex >= 0) {
                    openLightbox(cardIndex);
                }
            }

            track.addEventListener('click', function (e) {
                if (suppressClick) {
                    return;
                }

                const card = e.target.closest('.food-gallery__card');
                if (card) {
                    openCardModal(card);
                }
            });

            track.addEventListener('keydown', function (e) {
                if (e.key !== 'Enter' && e.key !== ' ') {
                    return;
                }
                const card = e.target.closest('.food-gallery__card');
                if (!card) {
                    return;
                }
                e.preventDefault();
                openCardModal(card);
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
                if (e.button !== 0) {
                    return;
                }
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

            startAutoplay();
        }

        section.querySelectorAll('[data-gallery-lightbox-close]').forEach(function (el) {
            el.addEventListener('click', closeLightbox);
        });

        if (lightboxPrev) {
            lightboxPrev.addEventListener('click', function (e) {
                e.stopPropagation();
                modalPrev();
            });
        }

        if (lightboxNext) {
            lightboxNext.addEventListener('click', function (e) {
                e.stopPropagation();
                modalNext();
            });
        }

        document.addEventListener('keydown', function (e) {
            if (!lightbox || lightbox.hidden) {
                return;
            }

            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                modalPrev();
            } else if (e.key === 'ArrowRight') {
                modalNext();
            }
        });

        requestAnimationFrame(function () {
            requestAnimationFrame(setup);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGallery);
    } else {
        initGallery();
    }
})();
