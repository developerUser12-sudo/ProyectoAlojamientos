<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Hola, {{ $usuario->name }}!</h1>
    <p>Has reservado el coche {{ $coche->marca }} {{ $coche->modelo}} de {{ $coche->origen }} a {{ $coche->destino }}</p>
    <h2>Ubicaciones:</h2>
    <ul>
        <li>Madrid: Calle Sevilla nº 6</li>
        <li>Sevilla: Calle Cadiz n º10</li>
    </ul>
</body>
</html>
