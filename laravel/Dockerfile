FROM php:8.2-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el proyecto al contenedor
WORKDIR /app
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-interaction --optimize-autoloader

# Generar cache config (evita errores)
RUN php artisan config:cache

# Exponer el puerto
EXPOSE 8000

# Comando para iniciar el servidor Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
