# PHP-FPM with needed extensions
FROM php:8.2-fpm-alpine

# System deps
RUN apk add --no-cache bash icu-dev libpq-dev git unzip curl \
    libpng libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip

# PHP extensions (pgsql + pdo_pgsql are both useful)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) gd intl zip pgsql pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Install PHP deps and set writable dirs
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
 && chown -R www-data:www-data storage bootstrap/cache

# Entrypoint (auto-run migrate + seed)
#COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
#RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000
USER www-data
#ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
