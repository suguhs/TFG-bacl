FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_pgsql bcmath

# Activar mod_rewrite para Laravel
RUN a2enmod rewrite

# Establecer el DocumentRoot en /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Cambiar el virtual host para servir desde /public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copiar el código del proyecto
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Asignar permisos necesarios
RUN chown -R www-data:www-data storage bootstrap/cache

# Ejecutar migraciones automáticamente
RUN php artisan config:clear && php artisan config:cache && php artisan migrate --force

# Exponer puerto 80 para Apache
EXPOSE 80
