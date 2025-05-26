# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Activar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip bcmath

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar archivos de Laravel al contenedor
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Dar permisos necesarios (puedes ajustar si hace falta)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instalar dependencias PHP con Composer
RUN composer install --no-interaction --optimize-autoloader

# Generar la clave de aplicación (evita errores en producción)
RUN php artisan config:cache
