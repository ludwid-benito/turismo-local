# Usamos PHP 8.3 con Apache para máxima compatibilidad con Laravel 12
FROM php:8.3-apache

# Instalamos dependencias del sistema y Node.js (para Vite)
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev \
    zip unzip git curl gnupg

# Instalamos extensiones de PHP necesarias para Laravel 12
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitamos el módulo de reescritura de Apache
RUN a2enmod rewrite

# Instalamos Composer de forma oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos los archivos del proyecto al contenedor
COPY . /var/www/html

# Instalamos las dependencias de PHP (sin las de desarrollo)
RUN composer install --no-dev --optimize-autoloader

# Ajustamos permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuramos Apache para que apunte a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80