/**
 * Penyimpanan galeri foto makanan di localStorage (dipakai website + admin).
 */
window.BentengGalleryStorage = (function () {
    const STORAGE_KEY = 'benteng_food_gallery';

    function read() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) {
                return [];
            }
            const parsed = JSON.parse(raw);
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function write(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
        window.dispatchEvent(new CustomEvent('benteng-gallery-updated', { detail: items }));
    }

    function getAll() {
        return read().sort((a, b) => new Date(b.uploadedAt) - new Date(a.uploadedAt));
    }

    function save(item) {
        const items = read();
        items.push(item);
        write(items);
        return item;
    }

    function remove(id) {
        const items = read().filter((item) => item.id !== id);
        write(items);
    }

    function cropToSquare(file, size) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = function () {
                const img = new Image();
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = size;
                    canvas.height = size;
                    const ctx = canvas.getContext('2d');
                    const minSide = Math.min(img.width, img.height);
                    const sx = (img.width - minSide) / 2;
                    const sy = (img.height - minSide) / 2;
                    ctx.drawImage(img, sx, sy, minSide, minSide, 0, 0, size, size);
                    resolve(canvas.toDataURL('image/jpeg', 0.88));
                };
                img.onerror = reject;
                img.src = reader.result;
            };
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    return {
        STORAGE_KEY,
        getAll,
        save,
        remove,
        cropToSquare,
    };
})();
