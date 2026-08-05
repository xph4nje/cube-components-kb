document.addEventListener('swiperInitialized', function(event) {
    const sliderOffers = document.querySelectorAll('.base-offers-columns');
    for(let i=0; i<sliderOffers.length;i++) {
        const slides = sliderOffers[i].querySelectorAll('.swiper-slide');
        if(slides.length > 1) {
            const container = sliderOffers[i].querySelector('.swiper-container');
            const arrowLeft = sliderOffers[i].querySelector('.base-offers-columns__nav__prev');
            const arrowRight = sliderOffers[i].querySelector('.base-offers-columns__nav__next');
            if(container !== null) {
                const sliderOffer = new Swiper(container, {
                    slidesPerView: 'auto',
                    loop: true,
                    speed: 1000,
                    centeredSlides: true,
                    autoplay: {
                        delay: 5000,
                    },
                    navigation: arrowLeft !== null && arrowRight !== null ? {
                        prevEl: arrowLeft,
                        nextEl: arrowRight,
                    } : {}
                });
            }
        }
    }
    initLazyLoading();
});