document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.view-button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const viewMode = this.getAttribute('data-view');
            setView(viewMode);
        });
    });

    function setView(columns) {
        const items = document.querySelectorAll('.event-item');
        const images = document.querySelectorAll('.event-item img');

        if (columns === 'list') {
            items.forEach(item => {
                item.style.width = '70%';
            });
            images.forEach(img => {
                img.style.width = '70%';
                img.style.height = 'auto';
            });
        } else {
            const width = (100 / columns) - 10 + '%';
            items.forEach(item => {
                item.style.width = width;
            });
            images.forEach(img => {
                img.style.width = '250px';
                img.style.height = '200px';
            });
        }
    }

    function adaptViewToSize() {
        const screenWidth = window.innerWidth;
        const btnTwo = document.querySelector('.view-button[data-view="2"]');
        const btnThree = document.querySelector('.view-button[data-view="3"]');
        const btnList = document.querySelector('.view-button[data-view="list"]');

        if (screenWidth <= 480) {
            btnTwo.style.display = 'none';
            btnThree.style.display = 'none';
            btnList.style.display = 'block';
            setView('1');
        } else if (screenWidth <= 768) {
            btnTwo.style.display = 'inline-block';
            btnThree.style.display = 'inline-block';
            btnList.style.display = 'inline-block';
            setView('2');
        } else {
            btnTwo.style.display = 'inline-block';
            btnThree.style.display = 'inline-block';
            btnList.style.display = 'inline-block';
            setView('3');
        }
    }

    window.addEventListener('resize', adaptViewToSize);

    adaptViewToSize();
});
