FROM php:latest

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip

#database
RUN docker-php-ext-install pdo_mysql zip

COPY . .

EXPOSE 8000

#starts the server at localhost:8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
