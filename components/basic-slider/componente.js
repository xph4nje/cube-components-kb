document.addEventListener('swiperInitialized', function(event) {
    const basicSliders = document.querySelectorAll('.basic-slider');
    for(let i=0; i<basicSliders.length;i++) {
        const container = basicSliders[i].querySelector('.swiper-container');
        const arrowLeft = basicSliders[i].querySelector('.basic-slider__nav__prev');
        const arrowRight = basicSliders[i].querySelector('.basic-slider__nav__next');
        if(container !== null) {
            const basicSlider = new Swiper(container, {
                slidesPerView: 'auto',
                loop: true,
                speed: 1000,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                },
                navigation: arrowLeft !== null && arrowRight !== null ? {
                    nextEl: arrowLeft,
                    prevEl: arrowRight,
                } : null,
            });
        }
    }
    initLazyLoading();
});