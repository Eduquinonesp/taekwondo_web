# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel y MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite de Apache (Laravel necesita .htaccess)
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto completo al contenedor
COPY . .

# Instalar dependencias de Composer
RUN apt-get update && apt-get install -y unzip git curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# 👉 Instalar Node.js 18 y compilar frontend con Vite
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm ci \
    && npm run build

# Dar permisos a la carpeta storage y bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Puerto expuesto
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]