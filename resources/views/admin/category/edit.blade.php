{{-- ── MODAL: EDIT KATEGORI ── --}}
<div class="btg-modal-overlay" id="modal-edit">
    <div class="btg-modal">

        <div class="btg-modal-head">
            <div class="btg-modal-head-icon blue">
                <i class="fas fa-pen"></i>
            </div>
            <div class="btg-modal-head-title">Edit Kategori</div>
            <button class="btg-modal-close" onclick="closeModal('modal-edit')">×</button>
        </div>

        <form id="form-edit" method="POST">
            @csrf
            @method('PUT')

            <div class="btg-modal-body">
                <label class="btg-label" for="edit-name">
                    Nama Kategori <span>*</span>
                </label>
                <input type="text" class="btg-input" id="edit-name" name="name" required
                    placeholder="Masukkan nama kategori baru">
                <div style="font-size:11.5px; color:var(--btg-muted); margin-top:7px;">
                    Slug akan diperbarui otomatis mengikuti nama baru.
                </div>
            </div>

            <div class="btg-modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-edit')">Batal</button>
                <button type="submit" class="btn-blue">
                    <i class="fas fa-save"></i> Perbarui
                </button>
            </div>
        </form>

    </div>
</div>

{{-- Auto-open jika ada validation error dari form edit --}}
@if ($errors->any() && old('_method') === 'PUT')
    <script>
        document.addEventListener('DOMContentLoaded', () => openModal('modal-edit'));
    </script>
@endif
