<x-mail::message>
# Evento Cancelado

    El evento "{{ $evento->titulo }}" ha sido cancelado. Lamentamos los inconvenientes que esto pueda causar.

<x-mail::button :url="'/'">
Visitar Sitio
</x-mail::button>

Atentamente,<br>
CulturaVibe
</x-mail::message>
