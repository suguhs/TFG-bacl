# Imagen base oficial con Apache y PHP 8.2
FROM php:8.2-apache

# Activar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar dependencias necesarias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip bcmath

# Instalar Composer desde otra imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto Laravel al contenedor
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Dar permisos necesarios a Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instalar dependencias PHP
RUN composer install --no-interaction --optimize-autoloader

# (Opcional) Solo si ya tienes variables definidas correctamente
# RUN php artisan config:cache
