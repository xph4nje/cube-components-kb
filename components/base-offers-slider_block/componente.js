document.addEventListener('swiperInitialized', function(event) {
    const sliderOffers = document.querySelectorAll('.base-offers-slider');
    for(let i=0; i<sliderOffers.length;i++) {
        const slides = sliderOffers[i].querySelectorAll('.swiper-slide');
        const center = sliderOffers[i].getAttribute("data-center") == "true";
        if(slides.length > 1) {
            const container = sliderOffers[i].querySelector('.swiper-container');
            const arrowLeft = sliderOffers[i].querySelector('.base-offers-slider__nav__prev');
            const arrowRight = sliderOffers[i].querySelector('.base-offers-slider__nav__next');
            const pagi = sliderOffers[i].querySelector('.pagination');
            if(container !== null) {
                const sliderOffer = new Swiper(container, {
                    slidesPerView: 'auto',
                    loop: true,
                    speed: 1000,
                    centeredSlides: center,
                    autoplay: {
                        delay: 5000,
                    },
                    navigation: arrowLeft !== null && arrowRight !== null ? {
                        prevEl: arrowLeft,
                        nextEl: arrowRight,
                    } : {},
                    pagination: pagi !== null ? {
                        el: pagi,
                        type: 'bullets',
                        clickable: true,
                    } : {}
                });
            }
        }
    }
    initLazyLoading();
});