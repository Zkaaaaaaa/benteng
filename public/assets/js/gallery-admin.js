/**
 * Kelola galeri foto di panel admin (localStorage).
 */
(function () {
    const root = document.querySelector('[data-gallery-admin]');
    if (!root || !window.BentengGalleryStorage) {
        return;
    }

    const listEl = root.querySelector('[data-gallery-list]');
    const tableWrap = root.querySelector('[data-gallery-table-wrap]');
    const emptyListEl = root.querySelector('[data-gallery-list-empty]');
    const form = root.querySelector('[data-gallery-form]');
    const nameInput = root.querySelector('[data-gallery-name]');
    const fileInput = root.querySelector('[data-gallery-file]');
    const dropzone = root.querySelector('[data-gallery-dropzone]');
    const previewImg = root.querySelector('[data-gallery-preview]');
    const previewWrap = root.querySelector('[data-gallery-preview-wrap]');
    const alertBox = root.querySelector('[data-gallery-alert]');
    const modalOverlay = document.getElementById('modal-gallery-preview');
    const modalImg = document.querySelector('[data-gallery-modal-img]');
    const modalCaption = document.querySelector('[data-gallery-modal-caption]');
    const uploadPreviewBtn = root.querySelector('[data-gallery-upload-preview-btn]');

    let pendingBase64 = null;

    function showAlert(message, type) {
        alertBox.hidden = false;
        alertBox.className = 'btg-alert ' + (type === 'danger' ? 'danger' : 'success');
        alertBox.innerHTML =
            '<div class="btg-alert-icon"><i class="fas fa-' + (type === 'danger' ? 'times' : 'check') + '"></i></div>' +
            '<div style="flex:1;">' + message + '</div>';
        setTimeout(function () {
            alertBox.hidden = true;
        }, 4000);
    }

    function formatDate(iso) {
        try {
            return new Date(iso).toLocaleString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
        } catch (e) {
            return iso;
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function openPreview(item) {
        if (!modalOverlay || !modalImg) {
            return;
        }
        modalImg.src = item.base64Image;
        modalImg.alt = item.name;
        modalCaption.textContent = item.name;
        modalOverlay.classList.add('open');
        modalOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closePreview() {
        if (!modalOverlay) {
            return;
        }
        modalOverlay.classList.remove('open');
        modalOverlay.setAttribute('aria-hidden', 'true');
        modalImg.removeAttribute('src');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-gallery-modal-close]').forEach(function (el) {
        el.addEventListener('click', closePreview);
    });

    if (modalOverlay) {
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) {
                closePreview();
            }
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains('open')) {
            closePreview();
        }
    });

    function renderList() {
        const items = BentengGalleryStorage.getAll();
        listEl.innerHTML = '';

        if (items.length === 0) {
            emptyListEl.hidden = false;
            tableWrap.hidden = true;
            return;
        }

        emptyListEl.hidden = true;
        tableWrap.hidden = false;

        items.forEach(function (item, index) {
            const tr = document.createElement('tr');
            tr.innerHTML =
                '<td><span class="row-num">' + (index + 1) + '</span></td>' +
                '<td>' +
                '<div class="gallery-admin__inline">' +
                '<button type="button" class="gallery-admin__thumb-btn" data-gallery-preview-id="' + item.id + '" title="Klik untuk lihat foto">' +
                '<img src="' + item.base64Image + '" alt="" class="gallery-admin__thumb" width="32" height="32" draggable="false">' +
                '</button>' +
                '<button type="button" class="gallery-admin__inline-text gallery-admin__open-preview" data-gallery-preview-id="' + item.id + '" title="Klik untuk lihat foto">' +
                '<span class="gallery-admin__name">' + escapeHtml(item.name) + '</span>' +
                '<span class="gallery-admin__date">' + formatDate(item.uploadedAt) + '</span>' +
                '</button>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="action-group" style="justify-content:flex-end;">' +
                '<button type="button" class="btn-action delete gallery-admin__delete" data-id="' + item.id + '">' +
                '<i class="fas fa-trash"></i> Hapus' +
                '</button>' +
                '</div>' +
                '</td>';
            listEl.appendChild(tr);
        });

        listEl.querySelectorAll('[data-gallery-preview-id]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = btn.getAttribute('data-gallery-preview-id');
                const item = items.find(function (i) {
                    return i.id === id;
                });
                if (item) {
                    openPreview(item);
                }
            });
        });

        listEl.querySelectorAll('.gallery-admin__delete').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = btn.getAttribute('data-id');
                const item = items.find(function (i) {
                    return i.id === id;
                });
                const label = item ? item.name : 'foto ini';
                if (confirm('Hapus "' + label + '" dari galeri?')) {
                    BentengGalleryStorage.remove(id);
                    renderList();
                    showAlert('Foto berhasil dihapus.', 'success');
                }
            });
        });
    }

    function setPreview(base64) {
        pendingBase64 = base64;
        if (base64) {
            previewImg.src = base64;
            previewWrap.hidden = false;
            uploadPreviewBtn.hidden = false;
        } else {
            previewImg.removeAttribute('src');
            previewWrap.hidden = true;
            uploadPreviewBtn.hidden = true;
        }
    }

    if (uploadPreviewBtn) {
        uploadPreviewBtn.addEventListener('click', function () {
            if (!pendingBase64) {
                return;
            }
            openPreview({
                base64Image: pendingBase64,
                name: nameInput.value.trim() || 'Pratinjau unggahan',
            });
        });
    }

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) {
            showAlert('Pilih file gambar (JPG, PNG, WebP).', 'danger');
            return;
        }
        BentengGalleryStorage.cropToSquare(file, 800)
            .then(function (base64) {
                setPreview(base64);
            })
            .catch(function () {
                showAlert('Gagal memproses gambar.', 'danger');
            });
    }

    fileInput.addEventListener('change', function () {
        if (fileInput.files[0]) {
            handleFile(fileInput.files[0]);
        }
    });

    dropzone.addEventListener('click', function () {
        fileInput.click();
    });

    dropzone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropzone.classList.add('is-dragover');
    });

    dropzone.addEventListener('dragleave', function () {
        dropzone.classList.remove('is-dragover');
    });

    dropzone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropzone.classList.remove('is-dragover');
        if (e.dataTransfer.files[0]) {
            handleFile(e.dataTransfer.files[0]);
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = nameInput.value.trim();
        if (!name) {
            showAlert('Isi nama hidangan / caption.', 'danger');
            return;
        }
        if (!pendingBase64) {
            showAlert('Pilih gambar terlebih dahulu.', 'danger');
            return;
        }

        BentengGalleryStorage.save({
            id: 'gal_' + Date.now() + '_' + Math.random().toString(36).slice(2, 9),
            name: name,
            base64Image: pendingBase64,
            uploadedAt: new Date().toISOString(),
        });

        nameInput.value = '';
        fileInput.value = '';
        setPreview(null);
        renderList();
        showAlert('Foto berhasil diunggah ke galeri.', 'success');
    });

    renderList();
})();
