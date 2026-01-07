# ===============================
# PHP 8.3 + Apache
# ===============================
FROM php:8.3-apache

# ===============================
# Dependencias del sistema
# ===============================
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ===============================
# Extensiones PHP necesarias
# ===============================
RUN docker-php-ext-install \
    pdo_pgsql \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# ===============================
# Apache
# ===============================
RUN a2enmod rewrite

# ===============================
# Copiar proyecto
# ===============================
WORKDIR /var/www/html
COPY . .

# ===============================
# Composer
# ===============================
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ===============================
# Composer install (OBLIGATORIO)
# ===============================
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ===============================
# Limpiar cache vieja (SIN BD)
# ===============================
RUN rm -f bootstrap/cache/*.php


# ===============================
# Limpiar caches Laravel
# ===============================
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear

# ===============================
# Permisos
# ===============================
RUN chown -R www-data:www-data storage bootstrap/cache

# ===============================
# Apache document root -> /public
# ===============================
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ===============================
# Puerto
# ===============================
EXPOSE 80

# ===============================
# Start Apache
# ===============================
CMD ["apache2-foreground"]
