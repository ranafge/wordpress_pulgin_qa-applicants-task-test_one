# Use a PHP image (you can customize the version if needed)
FROM php:8.1-apache

# Install necessary extensions (e.g., for PHP)
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html

# Expose port 80 to the host
EXPOSE 80
