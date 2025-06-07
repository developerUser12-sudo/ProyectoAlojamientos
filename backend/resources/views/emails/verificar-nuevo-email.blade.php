<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <img style="width: 300px;"
        src="https://res.cloudinary.com/dsknn9kcz/image/upload/v1748723583/ChatGPT_Image_31_may_2025_22_31_27_smx96w.png">

    <h1>¡Hola, {{ $usuario->name }}!</h1>
    <p>Accede al siguiente enlace para cambiar tu correo electrónico
    </p>
    <a href="{{ url('/email/change/confirm/'.$token) }}">Confirmar correo</a>
    <p>Si no solicitaste este cambio, puedes ignorar este mensaje</p>
    <p>Saludos, HolidaysNow</p>
</body>

</html>