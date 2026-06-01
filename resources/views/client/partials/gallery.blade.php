{{-- Galeri foto — tampil di index EN & NL --}}
@php($photos = $galleryPhotos ?? collect())
<section class="food-gallery is-visible" id="gallery" data-food-gallery aria-label="{{ $galleryHeading ?? 'Gallery' }}">
    <div class="food-gallery__container">
        <header class="food-gallery__header">
            <h2 class="food-gallery__title section-title section-title--center">{{ $galleryHeading ?? 'Gallery' }}</h2>
        </header>

        @if($photos->isNotEmpty())
            <div class="food-gallery__carousel-wrap">
                <button type="button" class="food-gallery__nav food-gallery__nav--prev" data-gallery-prev
                    aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="food-gallery__viewport" data-gallery-viewport>
                    <div class="food-gallery__track" data-gallery-track>
                        @foreach($photos as $photo)
                            <article class="food-gallery__card" role="button" tabindex="0"
                                aria-label="View {{ $photo->name }}">
                                <div class="food-gallery__card-inner">
                                    <img src="{{ $photo->image_url }}" alt="{{ $photo->name }}" loading="lazy"
                                        draggable="false">
                                    <div class="food-gallery__card-overlay">
                                        <span>{{ $photo->name }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="food-gallery__nav food-gallery__nav--next" data-gallery-next
                    aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        @else
            <p class="food-gallery__empty" data-gallery-empty>
                {{ $galleryEmptyText ?? 'Photos coming soon.' }}
            </p>
        @endif
    </div>

    <div class="food-gallery__lightbox" data-gallery-lightbox hidden aria-hidden="true" role="dialog"
        aria-modal="true" aria-labelledby="gallery-lightbox-caption">
        <button type="button" class="food-gallery__lightbox-close" data-gallery-lightbox-close
            aria-label="Close">&times;</button>
        <div class="food-gallery__lightbox-backdrop" data-gallery-lightbox-close></div>
        <button type="button" class="food-gallery__lightbox-nav food-gallery__lightbox-nav--prev"
            data-gallery-lightbox-prev aria-label="Previous photo" hidden>
            <i class="fas fa-chevron-left"></i>
        </button>
        <figure class="food-gallery__lightbox-dialog">
            <img src="" alt="" data-gallery-lightbox-img>
            <figcaption id="gallery-lightbox-caption" data-gallery-lightbox-caption></figcaption>
        </figure>
        <button type="button" class="food-gallery__lightbox-nav food-gallery__lightbox-nav--next"
            data-gallery-lightbox-next aria-label="Next photo" hidden>
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>
