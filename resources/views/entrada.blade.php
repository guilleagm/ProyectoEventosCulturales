<!DOCTYPE html>
<html>
<head>
    <title>Entrada al Evento</title>
</head>
<body>
<h1>Nombre del evento: {{ $evento->titulo }}</h1>
<div>
<p>Fecha: {{ $evento->fecha }}</p>
    <p>Hora: {{ substr($evento->hora, 0, 5) }}</p>
    <p>Número de entradas: {{ $numEntradas }}</p>
    <p>Gracias por utilizar nuestros servicios.</p>
    <p>CulturaVibe</p>
</div>
</body>
</html>
