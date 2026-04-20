# Ganti menjadi 8.4
FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl gd pdo_mysql bcmath zip

WORKDIR /var/www
COPY . .
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN git config --global --add safe.directory /var/www

EXPOSE 9000
CMD ["php-fpm"]