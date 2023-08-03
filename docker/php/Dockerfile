FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    default-mysql-client 
# Install MySQL client
# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html
USER root
RUN chmod 777 -R /var/www/html
CMD ["php-fpm"]

EXPOSE 9000