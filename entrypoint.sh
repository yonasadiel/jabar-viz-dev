#!/bin/ash
cd /home/vizdev/viz-dev-backend
cp .env.dev .env
composer update
php artisan key:generate
php-fpm7
echo "UP!"
nginx
