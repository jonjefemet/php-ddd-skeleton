
FROM php:8.3-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar los archivos del proyecto
COPY . .

# Instalar dependencias de Composer
RUN composer install

# # Exponer el puerto 8080
# EXPOSE 8080

# # Comando para iniciar el servidor
# CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]