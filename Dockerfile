FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install intl

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --optimize-autoloader

CMD php -S 0.0.0.0:$PORT -t public