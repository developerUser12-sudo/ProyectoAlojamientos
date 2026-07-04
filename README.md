## Resumen

Este proyecto es una aplicación web enfocada a la planificación de vacaciones, que permite a los usuarios reservar hoteles y coches de forma sencilla.

## Instalación

### Frontend

1. Instalar Node.js (última versión).
2. Instalar Angular ejecutando en la terminal:

```bash
npm install -g @angular/cli
```

Comprobar la instalación con:

```bash
ng version
```

3. Acceder a la carpeta `/frontend` y ejecutar:

```bash
npm install
```

4. Iniciar la aplicación con:

```bash
ng serve -o
```

### Backend

1. Instalar Composer (última versión).
2. Crear un archivo `.env` e introducir los parámetros necesarios para conectar con la base de datos.
3. Acceder a la carpeta `/backend` y ejecutar:

```bash
composer install
```

4. Crear la base de datos `proyectoalojamientos` y ejecutar las migraciones:

```bash
php artisan migrate
```

5. Iniciar el servidor con:

```bash
php artisan serve
```

## Sitio web desplegado

https://holidaysnow.onrender.com
