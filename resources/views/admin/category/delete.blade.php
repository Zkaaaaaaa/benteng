<div class="btg-modal-overlay" id="modal-delete">
    <div class="btg-modal modal-delete">

        <div class="delete-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h3 class="delete-title">Hapus Kategori</h3>

        <div class="btg-modal-body" style="padding: 0;">
            <p class="delete-text">
                Apakah Anda yakin ingin menghapus kategori <strong id="delete-category-name"></strong>?
            </p>

            <div id="delete-warning-box" class="delete-warning" style="display: none;">
                <i class="fas fa-exclamation-circle" style="font-size: 16px; margin-top: 2px;"></i>
                <div>
                    <strong>Peringatan!</strong> Kategori ini memiliki <strong id="delete-products-count">0</strong>
                    produk terkait.
                    Menghapus kategori ini juga akan menghapus secara permanen semua produk di dalamnya!
                </div>
            </div>

            <div id="delete-safe-box" class="delete-warning"
                style="background: #f0faf5; border-color: #a8e6c3; color: #1a6b3c; display: none;">
                <i class="fas fa-check-circle" style="color: #27ae60; font-size: 16px; margin-top: 2px;"></i>
                <div>
                    Kategori ini aman untuk dihapus karena tidak memiliki produk yang terkait.
                </div>
            </div>
        </div>

        <div class="delete-actions" style="margin-top: 20px;">
            <button type="button" class="btn-cancel" onclick="closeModal('modal-delete')">
                Batal
            </button>
            <form id="form-delete" method="POST" style="flex: 1; display: flex; margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-confirm" style="width: 100%;">
                    <i class="fas fa-trash-alt"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
