const boxFis = document.querySelectorAll('.box-fisarmonica__item');
const boxFisWrapper = document.querySelector('.box-fisarmonica__list');
const boxFisPics = document.querySelectorAll('.box-fisarmonica__pic');

boxFis.forEach(item => {
    item.addEventListener('click', () => {
        boxFis.forEach(el => {
            el.classList.remove('active');
        });
        item.classList.add('active');
    });
});

window.addEventListener('resize', () => {
    boxFisPics.forEach(pic => {
        if (boxFisWrapper) {
            pic.setAttribute('style', '--wrapper-width: ' + boxFisWrapper.offsetWidth + 'px');
        }
    });
});