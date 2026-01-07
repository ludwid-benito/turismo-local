FROM php:8.3-apache

# Instalamos herramientas necesarias para Composer (zip, unzip, git)
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libpq-dev \
    zip unzip git curl

# Instalamos extensiones de PHP para Laravel 12 y Postgres
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Habilitamos el módulo de reescritura de Apache
RUN a2enmod rewrite

# INSTALAMOS COMPOSER directamente en el contenedor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos todos los archivos del proyecto al contenedor
COPY . /var/www/html

# EJECUTAMOS LA INSTALACIÓN DE LIBRERÍAS (Crea la carpeta vendor)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ajustamos permisos de carpetas críticas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuramos la carpeta pública
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80