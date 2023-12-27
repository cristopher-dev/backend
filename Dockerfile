# Use an official PHP 8.2 image
FROM php:8.2-fpm

# Set timezone
RUN apt-get update && apt-get install -y tzdata && \
    rm -rf /var/lib/apt/lists/* && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g-dev

# Cambiar permisos de la carpeta /var/www/html (en tiempo de ejecución)
RUN mkdir -p /var/www/html && chmod -R 777 /var/www/html

# Install Redis and XDebug extensions
RUN pecl install redis-5.3.7 \
    && pecl install xdebug-3.2.2 \
    && docker-php-ext-enable redis xdebug

# Copy the configuration file
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Set the working directory to /var/www/html
WORKDIR /var/www/html
RUN chmod -R 777 /var/www/html

# Start PHP built-in web server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]

# Expose the FPM port (no es necesario exponer el puerto 9000 para el servidor web incorporado)
# EXPOSE 9000
