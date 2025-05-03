# Etapa 1: dependencias
FROM php:8.2-cli AS build

# Instala extensiones y dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia archivos del proyecto
WORKDIR /var/www
COPY . .

# Instala dependencias
RUN composer install --no-dev --optimize-autoloader

# Etapa 2: ejecución
FROM php:8.2-cli

WORKDIR /var/www

# Instala extensiones de nuevo
RUN apt-get update && apt-get install -y \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring

COPY --from=build /var/www /var/www

# Copia el binario de composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Puerto que Laravel usa por defecto
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
