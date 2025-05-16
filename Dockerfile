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
    $PHPIZE_DEPS

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

RUN pecl install redis \
    && mkdir -p /tmp/extensions \
    && cp $(php -r "echo ini_get('extension_dir');")/redis.so /tmp/extensions/ \
    && echo "extension=redis.so" > /tmp/extensions/redis.ini

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
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip sockets

COPY --from=build /tmp/extensions/redis.so /tmp/redis.so
RUN cp /tmp/redis.so "$(php -r 'echo ini_get("extension_dir");')"
RUN echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

COPY .env.docker /var/www/.env
COPY --from=build /var/www /var/www

COPY supervisord.conf /etc/supervisord.conf

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["sh", "/usr/local/bin/docker-entrypoint.sh"]
