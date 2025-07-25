FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/

# Install system dependencies for Composer
RUN apt-get update && apt-get install -y unzip curl

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application code
COPY . /var/www/html/

# Install PHP extensions
RUN docker-php-ext-install mysqli

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
