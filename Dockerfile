FROM php:latest

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8000

