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
                breakpoint: 480,
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
        vertical: true,
        verticalSwiping: true,
        responsive: [
            {
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
