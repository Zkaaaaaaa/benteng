{{-- ── MODAL: EDIT PRODUK ── --}}
<div class="btg-modal-overlay" id="modal-edit">
    <div class="btg-modal" style="max-width: 680px;">

        <div class="btg-modal-head">
            <div class="btg-modal-head-icon blue">
                <i class="fas fa-pen"></i>
            </div>
            <div class="btg-modal-head-title">Edit Produk</div>
            <button class="btg-modal-close" onclick="closeModal('modal-edit')">×</button>
        </div>

        <form id="form-edit" method="POST" enctype="multipart/form-data" style="margin: 0;">
            @csrf
            @method('PUT')
            <input type="hidden" name="_edit_id" id="edit-id" value="{{ old('_edit_id') }}">

            <div class="btg-modal-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="edit-name">
                                Nama Produk <span>*</span>
                            </label>
                            <input type="text" class="btg-input" id="edit-name" name="name" required
                                placeholder="Masukkan nama produk">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="edit-category_id">
                                Kategori <span>*</span>
                            </label>
                            <select class="btg-input" id="edit-category_id" name="category_id" required
                                style="appearance: auto;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="edit-price">
                                Harga (€) <span>*</span>
                            </label>
                            <input type="number" class="btg-input" id="edit-price" name="price" step="0.01"
                                min="0" required placeholder="12.50">
                        </div>
                    </div>

                    <div>
                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="edit-description_en">
                                Description (EN)
                            </label>
                            <textarea class="btg-input" id="edit-description_en" name="description_en" rows="3"
                                placeholder="Description in English..." style="resize: vertical; min-height: 80px;"></textarea>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="edit-description_nl">
                                Beschrijving (NL)
                            </label>
                            <textarea class="btg-input" id="edit-description_nl" name="description_nl" rows="3"
                                placeholder="Beschrijving in het Nederlands..." style="resize: vertical; min-height: 80px;"></textarea>
                        </div>

                        <div style="margin-bottom: 12px;">
                            <label class="btg-label" for="edit-image">
                                Ganti Gambar Produk
                            </label>
                            <input type="file" class="btg-input" id="edit-image" name="image" accept="image/*"
                                style="padding: 7px 10px;">
                            <div style="font-size:11px; color:var(--btg-muted); margin-top:5px;">
                                Format: JPG, JPEG, PNG, WEBP. Maks 2MB.
                            </div>
                        </div>

                        <div id="preview-container"
                            style="display: none; align-items: center; gap: 12px; padding: 10px; background: var(--btg-bg); border: 1px solid var(--btg-border); border-radius: 10px;">
                            <img id="edit-image-preview" src="" alt="Pratinjau"
                                style="max-height: 50px; max-width: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--btg-border);">
                            <div style="font-size: 12px; color: var(--btg-text); font-weight: 500;">Gambar aktif saat
                                ini</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btg-modal-footer" style="border-top: 1px solid var(--btg-border); padding-top: 16px;">
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
        document.addEventListener('DOMContentLoaded', () => {
            const editId = @json(old('_edit_id'));
            if (editId) {
                document.getElementById('form-edit').action = '/admin/products/' + editId;
            }

            document.getElementById('edit-name').value = @json(old('name', ''));
            document.getElementById('edit-category_id').value = @json(old('category_id', ''));
            document.getElementById('edit-price').value = @json(old('price', ''));
            document.getElementById('edit-description_en').value = @json(old('description_en', ''));
            document.getElementById('edit-description_nl').value = @json(old('description_nl', ''));

            openModal('modal-edit');
        });
    </script>
@endif
