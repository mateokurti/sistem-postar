# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    curl \
    git \
    unzip \
    vim \
    libicu-dev

# Install PHP extensions
RUN docker-php-ext-install intl pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Install application dependencies
RUN composer install --no-interaction --no-plugins --no-scripts

# # Enable the rewrite module
RUN a2enmod rewrite

# Start the Apache web server
CMD ["apache2-foreground"]