#!/bin/sh

cd /var/www

find bootstrap/cache ! -name .gitignore -exec chmod 777 {} \;
find storage ! -name .gitignore -exec chmod 777 {} \;

composer install
php artisan key:generate

exec apache2-foreground
