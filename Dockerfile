# === Stage 1: Build
FROM php:8.3-fpm-alpine AS build

RUN apk update && apk upgrade && apk add --no-cache \
    build-base \
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
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

WORKDIR /var/www

COPY . /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Delete vite HMR marker if exists
RUN rm -f public/hot

RUN composer install --optimize-autoloader --no-dev

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
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip sockets

COPY .env.production /var/www/.env
COPY --from=build /var/www /var/www

EXPOSE 9000

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["sh", "/usr/local/bin/docker-entrypoint.sh"]

