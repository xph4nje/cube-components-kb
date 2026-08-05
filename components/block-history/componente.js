window.historyFilter = (event) => {
    var allElements = document.querySelectorAll('.block-history__row');
    if(allElements.length > 0) {
        var container = event.target.closest('.block-history__row');
        if(container) {
            var wasActive = Array.from(container.classList).includes('active');
            for(var i=0; i<allElements.length; i++) {
                allElements[i].classList.remove('active');
            }
            if(!wasActive) {
                container.classList.add('active');
            }
        }
    }
};