{{-- Galeri foto — tampil di index EN & NL --}}
<section class="food-gallery" id="gallery" data-food-gallery aria-label="{{ $galleryHeading ?? 'Gallery' }}">
    <div class="food-gallery__container">
        <header class="food-gallery__header">
            <h2 class="food-gallery__title section-title section-title--center">{{ $galleryHeading ?? 'Gallery' }}</h2>
        </header>

        @forelse($galleryPhotos ?? [] as $photo)
            @if($loop->first)
                <div class="food-gallery__carousel-wrap">
                    <button type="button" class="food-gallery__nav food-gallery__nav--prev" data-gallery-prev
                        aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="food-gallery__viewport" data-gallery-viewport>
                        <div class="food-gallery__track" data-gallery-track>
            @endif
                            <article class="food-gallery__card">
                                <div class="food-gallery__card-inner">
                                    <img src="{{ $photo->image_url }}" alt="{{ $photo->name }}" loading="lazy"
                                        draggable="false">
                                    <div class="food-gallery__card-overlay">
                                        <span>{{ $photo->name }}</span>
                                    </div>
                                </div>
                            </article>
            @if($loop->last)
                        </div>
                    </div>
                    <button type="button" class="food-gallery__nav food-gallery__nav--next" data-gallery-next
                        aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            @endif
        @empty
            <p class="food-gallery__empty" data-gallery-empty>
                {{ $galleryEmptyText ?? 'Photos coming soon.' }}
            </p>
        @endforelse
    </div>

    <div class="food-gallery__lightbox" data-gallery-lightbox hidden aria-hidden="true">
        <button type="button" class="food-gallery__lightbox-close" data-gallery-lightbox-close
            aria-label="Close">&times;</button>
        <div class="food-gallery__lightbox-backdrop" data-gallery-lightbox-close></div>
        <figure class="food-gallery__lightbox-dialog">
            <img src="" alt="" data-gallery-lightbox-img>
            <figcaption data-gallery-lightbox-caption></figcaption>
        </figure>
    </div>
</section>
