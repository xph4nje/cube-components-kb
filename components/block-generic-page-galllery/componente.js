window.genericGalleryFilter = (index, categoryID) => {
    var allElements = document.querySelectorAll('.block-generic-page-galllery li[data-cat]');
    if(allElements.length > 0) {
        for(var i=0; i<allElements.length; i++) {
            allElements[i].classList.add('filter-disable');
        }
        if( categoryID == '0' ) {
            for(var i=0; i<allElements.length; i++) {
                allElements[i].classList.remove('filter-disable');
            }
        } else {
            var filterredElements = document.querySelectorAll('.block-generic-page-galllery li[data-cat="' + categoryID + '"]');
            if(filterredElements.length > 0) {
                for(var i=0; i<filterredElements.length; i++) {
                    filterredElements[i].classList.remove('filter-disable');
                }
            }
        }
        var allFilters = document.querySelectorAll('.block-generic-page-galllery__cats a');
        if(allFilters.length > 0) {
            for(var i=0; i<allFilters.length; i++) {
                if(i !== index) {
                    allFilters[i].classList.remove('active');
                } else {
                    allFilters[i].classList.add('active');
                }
            }
        }
    }
};
const catContainer = document.querySelector('.block-generic-page-galllery__cats');
let startCat = 0;
if(catContainer !== null) {
    const startCatAttr = catContainer.getAttribute('data-startCat');
    startCat = startCatAttr !== '' ? startCatAttr : 0;
}
window.genericGalleryFilter(0, startCat);
document.addEventListener('simplelightboxInitialized', function(event) {
    if(document.querySelectorAll('.sml').length > 0) {
        new SimpleLightbox({elements: 'a.sml'});
    }
});