<!DOCTYPE html>
<html>
<head>
    <title>Entrada al Evento</title>
</head>
<body>
<h1>Nombre del evento: {{ $evento->titulo }}</h1>
<div>
    <center><p>Fecha: {{ $evento->fecha }}</p></center>
    <center><p>Hora: {{ substr($evento->hora, 0, 5) }}</p></center>
    <center><p>Número de entradas: {{ $numEntradas }}</p></center>
    <center><p>Gracias por utilizar nuestros servicios.</p></center>
    <center><p>CulturaVibe</p></center>
</div>
</body>
</html>
