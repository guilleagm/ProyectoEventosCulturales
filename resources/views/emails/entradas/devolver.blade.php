<x-mail::message>
# Devolución Confirmada

Hemos registrado la devolución de tus entradas para el evento **{{ $titulo }}**.

    **Detalles del Evento:**
    - **Fecha:** {{ $fecha }}
    - **Hora:** {{ substr($evento->hora, 0, 5) }}
    - **Lugar:** {{ $lugar }}
    - **Entradas Devueltas:** {{ $numEntradas }}

    Gracias por usar nuestros servicios.
    CulturaVibe
</x-mail::message>
