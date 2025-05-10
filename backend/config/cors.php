<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'],
    'allowed_methods' => ['*'], // Permite todos los métodos HTTP
    'allowed_origins' => ['*'], // Permite solo solicitudes de este dominio
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permite todos los encabezados
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Permite cookies y credenciales
];
