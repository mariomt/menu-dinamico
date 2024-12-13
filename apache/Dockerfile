FROM php:8.2-apache
USER root
WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y vim wget

RUN a2enmod rewrite

# Copy Apache configuration
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

RUN service apache2 restart
