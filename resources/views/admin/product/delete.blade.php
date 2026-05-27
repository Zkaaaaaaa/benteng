<div class="btg-modal-overlay" id="modal-delete">
    <div class="btg-modal modal-delete">

        <div class="delete-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h3 class="delete-title">Hapus Produk</h3>

        <div class="btg-modal-body" style="padding: 0;">
            <p class="delete-text">
                Apakah Anda yakin ingin menghapus produk <strong id="delete-product-name"></strong>?
            </p>

            <div class="delete-warning">
                <i class="fas fa-exclamation-circle" style="font-size: 16px; margin-top: 2px;"></i>
                <div>
                    <strong>Perhatian!</strong> Produk yang dihapus beserta seluruh data dan gambarnya akan dihapus
                    secara permanen dari sistem dan tidak dapat dikembalikan.
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
