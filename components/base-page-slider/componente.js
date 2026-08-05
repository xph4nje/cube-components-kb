document.addEventListener('swiperInitialized', function(event) {
    const basicPageSliders = document.querySelectorAll('.base-page-slider');
    for(let i=0; i<basicPageSliders.length;i++) {
        const container = basicPageSliders[i].querySelector('.swiper-container');
        const centerSlides = basicPageSliders[i].getAttribute("data-align") == "center";
        const arrowLeft = basicPageSliders[i].querySelector('.base-page-slider__nav__prev');
        const arrowRight = basicPageSliders[i].querySelector('.base-page-slider__nav__next');
        const pagi = basicPageSliders[i].querySelector('.pagination');
        if(container !== null) {
            let params = {
                slidesPerView: 'auto',
                loop: true,
                speed: 1000,
                centeredSlides: centerSlides,
                autoplay: {
                    delay: 5000,
                },
                pagination: pagi !== null ? {
                    el: pagi,
                    type: 'bullets',
                    clickable: true,
                } : {}
            };
            if(arrowLeft !== null && arrowRight !== null) {
                params['navigation'] = {
                    nextEl: arrowRight,
                    prevEl: arrowLeft
                }
            }
            const currentSlider = new Swiper(container, params);
            
        }
    }
    initLazyLoading();
});