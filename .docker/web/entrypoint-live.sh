#!/bin/sh

cd /var/www

find bootstrap/cache ! -name .gitignore -exec chmod 777 {} \;
find storage ! -name .gitignore -exec chmod 777 {} \;

sh -c "composer install; php artisan migrate; if [ -z \$(grep '^APP_KEY=.\{10,\}' .env) ]; then php artisan key:generate; fi" &
sh -c "php artisan storage:link" &

if [ $DISABLE_NPM_AUTORUN != true ]; then
    npm config set strict-ssl=false && npm install && npm run production &
fi

exec sh -c "php artisan print:pull-queue  --watch"
