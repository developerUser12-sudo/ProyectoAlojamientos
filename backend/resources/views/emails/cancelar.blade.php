<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <img style="width: 300px;"
        src="https://res.cloudinary.com/dsknn9kcz/image/upload/v1748723583/ChatGPT_Image_31_may_2025_22_31_27_smx96w.png">

    <h1>¡Hola, {{ $usuario->name }}!</h1>
    @if($habitacion)
    <p>Has cancelado tu reserva del hotel {{ $hotel->nombre }}, habitación {{ $habitacion->tipo_habitacion }}
    </p>
    @else
    <p>Has cancelado tu viaje en coche {{ $coche->marca }} {{ $coche->modelo }}
    </p>
    @endif
    <p>Saludos, HolidaysNow</p>
</body>

</html>