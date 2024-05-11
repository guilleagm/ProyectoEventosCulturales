$(document).ready(function() {
    // Configuración para el carrusel de eventos
    $('.event-carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnHover: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Configuración para el carrusel de noticias (vertical)
    $('.news-container').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnHover: true,
        vertical: true,  // Habilita el desplazamiento vertical
        verticalSwiping: true, // Permite el deslizamiento vertical con gestos táctiles
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    vertical: false, // Deshabilita vertical en pantallas pequeñas
                    verticalSwiping: false
                }
            }
        ]
    });
});
