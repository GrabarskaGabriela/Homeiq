#!/bin/bash

composer install

npm install

php artisan migrate

php artisan key:generate

php artisan db:seed

chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/storage

php artisan storage:link

npm run build
