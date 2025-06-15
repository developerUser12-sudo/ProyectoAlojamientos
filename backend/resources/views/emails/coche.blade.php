<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <img style="width: 300px;"
        src="https://res.cloudinary.com/dsknn9kcz/image/upload/v1748723583/ChatGPT_Image_31_may_2025_22_31_27_smx96w.png">

    <h1>¡Hola, {{ $usuario->name }}!</h1>
    <p>Has reservado el coche {{ $coche->marca }} {{ $coche->modelo}} de {{ $coche->origen }} a {{ $coche->destino }}
    </p>
    <p>Tu código de reserva es {{ $codigoReserva }}. Presentelo al llegar al establecimiento</p>
    <h2>Acude el día de reserva a la ubicacion de tu ciudad de destino:</h2>
    <ul>
        <li>Madrid: Calle Sevilla nº 6</li>
        <li>Sevilla: Calale Cadiz n º10</li>
        <li>Barcelona: Calle Utrera n º10</li>
    </ul>
    <p>Saludos, HolidaysNow</p>
</body>

</html>