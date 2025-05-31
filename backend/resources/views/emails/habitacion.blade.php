<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <img style="width: 300px;" src="https://res.cloudinary.com/dsknn9kcz/image/upload/v1748723583/ChatGPT_Image_31_may_2025_22_31_27_smx96w.png">
    <h1>¡Hola, {{ $usuario->name }}!</h1>
    <p>Has reservado tu habitación {{ $habitacion->tipo_habitacion }} en {{ $hotel->nombre}}</p>
    <p>Recuerda que la dirección del hotel es {{ $hotel->direccion }}, {{ $hotel->localizacion }}</p>
    <p>Saludos, HolidaysNow</p>
</body>
</html>
