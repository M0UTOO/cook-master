# Use the official PHP image with Apache support
FROM php:7.4-apache

# Copy the API file to the document root
COPY index.php /var/www/html/

# Copy the custom Apache configuration file
COPY custom.conf /etc/apache2/conf-available/

# Enable the custom configuration and URL rewriting for Apache
RUN a2enconf custom \
    && a2enmod rewrite

# Set the working directory to the document root
WORKDIR /var/www/html
