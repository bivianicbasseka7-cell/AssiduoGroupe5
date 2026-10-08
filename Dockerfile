FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    mariadb-dev \
    icu-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql intl zip opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html