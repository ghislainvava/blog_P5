ARG PHP_VERSION=8.0
ARG COMPOSER_VERSION=2

FROM composer:${COMPOSER_VERSION} AS composer


FROM php:${PHP_VERSION}-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www
WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction

CMD ["php-fpm"]