FROM php:8.2-apache

# Instalar dependencias necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Activar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Establecer el DocumentRoot en /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Reescribir la configuración para apuntar al directorio correcto
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copiar el contenido del proyecto Laravel al contenedor
COPY . /var/www/html

WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Asignar permisos necesarios
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer el puerto para Apache
EXPOSE 80
