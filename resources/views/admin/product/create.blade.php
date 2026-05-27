{{-- ── MODAL: TAMBAH PRODUK ── --}}
<div class="btg-modal-overlay" id="modal-add">
    <div class="btg-modal" style="max-width: 680px;">

        <div class="btg-modal-head">
            <div class="btg-modal-head-icon primary">
                <i class="fas fa-plus"></i>
            </div>
            <div class="btg-modal-head-title">Tambah Produk Baru</div>
            <button class="btg-modal-close" onclick="closeModal('modal-add')">×</button>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
            style="margin: 0;">
            @csrf

            <div class="btg-modal-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-name">
                                Nama Produk <span>*</span>
                            </label>
                            <input type="text" class="btg-input" id="add-name" name="name" required
                                placeholder="Contoh: Nasi Goreng Spesial" value="{{ old('name') }}">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-category_id">
                                Kategori <span>*</span>
                            </label>
                            <select class="btg-input" id="add-category_id" name="category_id" required
                                style="appearance: auto;">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-price">
                                Harga (€) <span>*</span>
                            </label>
                            <input type="number" class="btg-input" id="add-price" name="price" step="0.01"
                                min="0" required placeholder="12.50" value="{{ old('price') }}">
                        </div>
                    </div>

                    <div>
                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-description_en">
                                Description (EN)
                            </label>
                            <textarea class="btg-input" id="add-description_en" name="description_en" rows="3"
                                placeholder="Describe ingredients or notes in English..." style="resize: vertical; min-height: 80px;">{{ old('description_en') }}</textarea>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-description_nl">
                                Beschrijving (NL)
                            </label>
                            <textarea class="btg-input" id="add-description_nl" name="description_nl" rows="3"
                                placeholder="Beschrijf ingrediënten of notities in het Nederlands..." style="resize: vertical; min-height: 80px;">{{ old('description_nl') }}</textarea>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label class="btg-label" for="add-image">
                                Gambar Produk
                            </label>
                            <input type="file" class="btg-input" id="add-image" name="image" accept="image/*"
                                style="padding: 7px 10px;">
                            <div style="font-size:11px; color:var(--btg-muted); margin-top:5px;">
                                Format: JPG, JPEG, PNG, WEBP. Maks 2MB.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btg-modal-footer" style="border-top: 1px solid var(--btg-border); padding-top: 16px;">
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
