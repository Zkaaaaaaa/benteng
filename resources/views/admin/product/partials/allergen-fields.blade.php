@php
    $selectedKeys = $selectedKeys ?? old('allergens', []);
    $selectedKeys = is_array($selectedKeys) ? $selectedKeys : [];
@endphp

<div style="margin-top: 8px; padding-top: 16px; border-top: 1px solid var(--btg-border);">
    <label class="btg-label">Alergen Produk</label>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px 16px; margin-top: 10px;">
        @foreach (\App\Models\Product::allergenCatalog() as $key => $meta)
            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: var(--btg-text); cursor: pointer;">
                <input type="checkbox" name="allergens[]" value="{{ $key }}"
                    {{ in_array($key, $selectedKeys, true) ? 'checked' : '' }}
                    style="width: 15px; height: 15px; accent-color: var(--btg-accent);">
                {{ $meta['en'] }}
            </label>
        @endforeach
    </div>
</div>
