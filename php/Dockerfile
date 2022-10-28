FROM php:8.1-fpm

RUN apt-get update \
    && apt-get -y install --no-install-recommends \
    && apt-get install -y libicu-dev libzip-dev \
    && docker-php-ext-install intl zip \
    && apt-get -y install git

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

RUN mkdir -p /appdata/www
RUN chmod -R +x /appdata/www

WORKDIR /appdata/www