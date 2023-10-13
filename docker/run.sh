#!/bin/sh

if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

cp ./docker/apache/000-default.conf /etc/apache2/sites-available

chmod -R 777 storage

if [ ! -f /usr/local/bin/composer ]; then
   curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

composer install

php artisan migrate

a2enmod rewrite
apache2-foreground