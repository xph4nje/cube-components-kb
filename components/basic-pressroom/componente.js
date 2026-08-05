window.genericPressroomFilter = (index, categoryID) => {
    const allElements = document.querySelectorAll('.basic-pressroom__list__el');
    const allFilters = document.querySelectorAll('.basic-pressroom__filters__filter');

    if (allElements.length > 0) {
        allElements.forEach(el => el.classList.add('is-hidden'));

        const catStr = String(categoryID);

        if (catStr === '0') {
            allElements.forEach(el => el.classList.remove('is-hidden'));
        } else {
            allElements.forEach(el => {
                if (el.dataset.cat === catStr) {
                    el.classList.remove('is-hidden');
                }
            });
        }
    }

    if (allFilters.length > 0) {
        allFilters.forEach((btn, i) => {
            const a = btn.querySelector('a');
            if (a) {
                if (i === index) {
                    a.classList.add('active');
                } else {
                    a.classList.remove('active');
                }
            }
        });
    }
};
