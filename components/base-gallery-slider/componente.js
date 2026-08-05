document.addEventListener('swiperInitialized', function(event) {
    const basicGallerySliders = document.querySelectorAll('.base-gallery-slider');
    for(let i=0; i<basicGallerySliders.length;i++) {
        const container = basicGallerySliders[i].querySelector('.swiper-container');
        const centerSlides = basicGallerySliders[i].getAttribute("data-align") == "center";
        const arrowLeft = basicGallerySliders[i].querySelector('.base-gallery-slider__nav__prev');
        const arrowRight = basicGallerySliders[i].querySelector('.base-gallery-slider__nav__next');
        if(container !== null) {
            const basicGallerySlider = new Swiper(container, {
                slidesPerView: 'auto',
                loop: true,
                speed: 1000,
                centeredSlides: centerSlides,
                autoplay: {
                    delay: 2000,
                },
                navigation: arrowLeft !== null && arrowRight !== null ? {
                    nextEl: arrowRight,
                    prevEl: arrowLeft,
                } : false,
            });
        }
    }
    initLazyLoading();
});

document.addEventListener('simplelightboxInitialized', function(event) {
    if(document.querySelectorAll('.bgsGallery').length > 0) {
        new SimpleLightbox({elements: 'a.bgsGallery'});
    }
});