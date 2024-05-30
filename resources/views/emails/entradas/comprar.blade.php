<x-mail::message>
# Confirmación de Compra de Entradas
Gracias por comprar entradas para {{ $evento->titulo }}. Aquí están los detalles del evento:

        **Evento:** {{ $evento->titulo }}
        **Fecha:** {{ $evento->fecha }}
        **Hora:** {{ substr($evento->hora, 0, 5) }}
        **Lugar:** {{ $evento->sede->nombre }}, {{ $evento->sede->dirección }}
        **Cantidad de Entradas:** {{ $numEntradas }}

    Gracias por tu compra,
CulturaVibe
</x-mail::message>
