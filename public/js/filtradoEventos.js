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
        const images = document.querySelectorAll('.event-item img'); // Seleccionar las imágenes también

        if (columns === 'list') {
            items.forEach(item => {
                item.style.width = '70%';
            });
            images.forEach(img => {
                img.style.width = '70%'; // Ajusta el ancho de la imagen al ancho del contenedor
                img.style.height = 'auto'; // Ajusta la altura automáticamente
            });
        } else {
            const width = (100 / columns) - 10 + '%';
            items.forEach(item => {
                item.style.width = width;
            });
            images.forEach(img => {
                img.style.width = '250px'; // Restablece el tamaño original de las imágenes
                img.style.height = '200px';
            });
        }
    }

    // Llamada inicial a setView con '2' para establecer dos columnas al cargar la página
    setView('2');
});
