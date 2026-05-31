{{-- Galeri foto makanan — file terisolasi, tidak mengubah section lain --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/gallery.css') }}">
@endpush

<section class="food-gallery" id="gallery" data-food-gallery aria-label="{{ $galleryHeading ?? 'Gallery' }}">
    <div class="food-gallery__container">
        <header class="food-gallery__header">
            <h2 class="food-gallery__title section-title section-title--center">{{ $galleryHeading ?? 'Gallery' }}</h2>
        </header>

        <p class="food-gallery__empty" data-gallery-empty hidden>
            {{ $galleryEmptyText ?? 'Photos coming soon.' }}
        </p>

        <div class="food-gallery__carousel-wrap">
            <button type="button" class="food-gallery__nav food-gallery__nav--prev" data-gallery-prev aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="food-gallery__viewport" data-gallery-viewport>
                <div class="food-gallery__track" data-gallery-track></div>
            </div>
            <button type="button" class="food-gallery__nav food-gallery__nav--next" data-gallery-next aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="food-gallery__lightbox" data-gallery-lightbox hidden aria-hidden="true">
        <button type="button" class="food-gallery__lightbox-close" data-gallery-lightbox-close aria-label="Close">&times;</button>
        <div class="food-gallery__lightbox-backdrop" data-gallery-lightbox-close></div>
        <figure class="food-gallery__lightbox-dialog">
            <img src="" alt="" data-gallery-lightbox-img>
            <figcaption data-gallery-lightbox-caption></figcaption>
        </figure>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/gallery-storage.js') }}" defer></script>
    <script src="{{ asset('assets/js/gallery-carousel.js') }}" defer></script>
@endpush
