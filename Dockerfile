# Etap budowania aplikacji
FROM composer:2.6 as builder

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Etap produkcyjny
FROM php:8.2-apache

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    pdo_mysql \
    zip \
    gd \
    mbstring \
    opcache \
    && a2enmod rewrite

# Konfiguracja Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Skopiowanie aplikacji z etapu budowania
COPY --from=builder /app /var/www/html

# Ustawienia praw dostępu
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Konfiguracja PHP
COPY docker/php.ini /usr/local/etc/php/conf.d/php.ini

# Zainstaluj Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Zainstaluj Node.js i npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html
