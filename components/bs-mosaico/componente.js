document.addEventListener('simplelightboxInitialized', function(event) {
    if(document.querySelectorAll('.sml').length > 0) {
        new SimpleLightbox({elements: 'a.sml'});
    }
});