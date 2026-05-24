FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pcntl

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

ENV NPM_CONFIG_CACHE=/tmp/.npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer