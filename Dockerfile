# Use the official PHP image with Apache
FROM php:8.2-apache

# Copy project files to the container
COPY . /var/www/html/

# Set recommended permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
