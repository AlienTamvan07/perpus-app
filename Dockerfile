FROM php:8.1-apache
RUN apt-get update && docker-php-ext-install mysqli pdo && docker-php-ext-enable mysqli pdo
COPY src/ /var/www/html/