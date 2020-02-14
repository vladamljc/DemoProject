FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
       libicu-dev \
    && docker-php-ext-install \
        intl \
    && docker-php-ext-enable \
       intl

RUN docker-php-ext-install pdo_mysql

RUN mkdir -p /code
COPY . /code

