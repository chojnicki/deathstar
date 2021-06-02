#
# Develop stage
#
FROM php:8.0-fpm-alpine as dev

ARG UID=1000
ARG GID=1000

RUN apk add --update --no-cache \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-install \
    pdo_mysql \
    exif \
    pcntl \
    bcmath \
    gd

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis    

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN addgroup -g $GID laravel && \
    adduser -u $UID -G laravel -s /bin/sh -D laravel

RUN chown $UID:$GID /var/www/html
USER laravel

# rest is in init.sh executed by docker-compose for keeping prop build clean

WORKDIR /var/www/html


#
# Build stage
#
FROM dev as build

COPY database database
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist


#
# Production stage
#
FROM build as prod

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

RUN rm -rf /usr/bin/composer

COPY . .

RUN php artisan storage:link
RUN php artisan config:cache
RUN php artisan route:cache
