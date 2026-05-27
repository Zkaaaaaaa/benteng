{{-- ── MODAL: TAMBAH KATEGORI ── --}}
<div class="btg-modal-overlay" id="modal-add">
    <div class="btg-modal">

        <div class="btg-modal-head">
            <div class="btg-modal-head-icon primary">
                <i class="fas fa-plus"></i>
            </div>
            <div class="btg-modal-head-title">Tambah Kategori Baru</div>
            <button class="btg-modal-close" onclick="closeModal('modal-add')">×</button>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="btg-modal-body">
                <label class="btg-label" for="add-name">
                    Nama Kategori <span>*</span>
                </label>
                <input type="text" class="btg-input" id="add-name" name="name" required autofocus
                    placeholder="Contoh: Sayuran, Daging, Minuman…" value="{{ old('name') }}">
                <div style="font-size:11.5px; color:var(--btg-muted); margin-top:7px;">
                    Slug akan dibuat otomatis dari nama kategori.
                </div>
            </div>

            <div class="btg-modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-add')">Batal</button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>

    </div>
</div>

{{-- Auto-open jika ada validation error (form add was submitted) --}}
@if ($errors->any() && !old('_method'))
    <script>
        document.addEventListener('DOMContentLoaded', () => openModal('modal-add'));
    </script>
@endif
