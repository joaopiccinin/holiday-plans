FROM php:8.2
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN chown -R www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-scripts --no-autoloader

RUN composer require --dev phpunit/phpunit

RUN composer require barryvdh/laravel-dompdf

CMD php artisan serve --host=0.0.0.0 --port=8000
