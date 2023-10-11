#!/bin/sh

if [ ! -f .env ]; then
    cp .env.example .env
fi

cp ./docker/apache/000-default.conf /etc/apache2/sites-available

if [ ! -f /usr/local/bin/composer ]; then
   curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

composer install

php artisan key:generate

a2enmod rewrite
apache2-foreground