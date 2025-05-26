# Usa PHP 8.2 con CLI (sin Apache, solo consola)
FROM php:8.2-cli

# Instala dependencias necesarias para Laravel y Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer (gestor de paquetes de PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crea directorio de trabajo donde vive tu proyecto
WORKDIR /app

# Copia todos los archivos al contenedor
COPY . .

# Instala las dependencias del proyecto Laravel
RUN composer install --no-interaction --optimize-autoloader

# Genera la caché de configuración (evita errores de entorno en producción)
RUN php artisan config:cache || true

# Expone el puerto por donde Laravel servirá la app
EXPOSE 8000

# Comando que ejecuta Laravel en modo desarrollo
CMD php artisan serve --host=0.0.0.0 --port=8000
