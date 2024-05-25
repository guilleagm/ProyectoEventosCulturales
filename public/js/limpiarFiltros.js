document.addEventListener('DOMContentLoaded', function () {
    const clearButton = document.getElementById('clear-filters');
    const filterForm = document.getElementById('filter-form');

    clearButton.addEventListener('click', function() {
        filterForm.reset();
        filterForm.submit();
    });
});
