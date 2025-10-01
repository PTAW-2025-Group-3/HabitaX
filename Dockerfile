# === Stage 1: Build
FROM php:8.3-fpm-alpine AS build

RUN apk update && apk upgrade && apk add --no-cache \
    build-base \
    autoconf \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libpq-dev \
    libzip-dev \
    icu-dev \
    $PHPIZE_DEPS

RUN docker-php-ext-install intl pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

WORKDIR /var/www

COPY . /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --optimize-autoloader #--no-dev

# === Stage 2: Runtime
FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache \
    linux-headers \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libpq-dev \
    oniguruma-dev \
    nodejs \
    npm \
    supervisor \
    icu-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-install intl pdo pdo_pgsql mbstring exif pcntl bcmath gd zip sockets \
    && pecl install redis \
    && docker-php-ext-enable redis

COPY .env.docker /var/www/.env
COPY --from=build /var/www /var/www

COPY supervisord.conf /etc/supervisord.conf

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["sh", "/usr/local/bin/docker-entrypoint.sh"]
