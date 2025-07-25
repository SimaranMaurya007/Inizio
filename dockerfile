FROM php:8.2-apache
RUN a2enmod rewrite
WORKDIR /var/www/html/
COPY . /var/www/html/
RUN docker-php-ext-install mysqli
