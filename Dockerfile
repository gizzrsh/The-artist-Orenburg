FROM php:8.5-apache AS base
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html