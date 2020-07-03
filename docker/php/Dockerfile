FROM php:7-alpine 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

# Add PHPIZE deps
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS

## XDebug 2.9.6
RUN pecl install xdebug-2.9.6 \
   && docker-php-ext-enable xdebug

## Redis 5.2.2
RUN pecl install redis-5.2.2 \
   && docker-php-ext-enable redis

## PostgreSQL
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install -j $(nproc) pgsql pdo_pgsql

## MySQL
# RUN docker-php-ext-install -j $(nproc) mysqli pdo_mysql

## Zip
# RUN apk add --no-cache libzip-dev \
#    && docker-php-ext-install -j$(nproc) zip

## GD
# RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libwebp-dev \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
#    && docker-php-ext-install -j$(nproc) gd

## ImageMagick 6
# RUN apk add imagemagick6-dev \
#   && pecl install imagick-3.4.4 \
#   && docker-php-ext-enable imagick

## Calendar
# RUN docker-php-ext-install -j$(nproc) calendar

## Sockets
# RUN docker-php-ext-install -j$(nproc) sockets

## Enable Opcache
# RUN docker-php-ext-enable opcache 

# Cleanup PHPIZE deps
RUN apk del .phpize-deps

# Custom PHP configs
ADD custom.ini /usr/local/etc/php/conf.d/custom.ini