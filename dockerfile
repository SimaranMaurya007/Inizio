FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql

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

# Install dos2unix and sed for line ending and BOM fixes
RUN apt-get update && apt-get install -y dos2unix

# Convert all PHP files to LF line endings and remove BOM
RUN find /var/www/html -name "*.php" -exec dos2unix {} \; \
    && find /var/www/html -name "*.php" -exec sed -i '1s/^\xEF\xBB\xBF//' {} \;

# Install PHP extensions
RUN docker-php-ext-install mysqli

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure upload directory exists and is writable
RUN mkdir -p /var/www/html/images/sponsors && chown -R www-data:www-data /var/www/html/images

# Set PHP production settings
RUN echo "display_errors=Off\nexpose_php=Off" > /usr/local/etc/php/conf.d/production.ini

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
