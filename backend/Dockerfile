FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

EXPOSE 80
