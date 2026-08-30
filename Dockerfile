FROM php:8.5-apache AS base
RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite headers expires deflate \
    && sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf
COPY . /var/www/html