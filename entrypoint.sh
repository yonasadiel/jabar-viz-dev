#!/bin/ash

# exit immediately if one of commands fails
set -e

# start postgresql
(su -c 'postgres -D /home/vizdev/dbdata &' postgres)

cd /home/vizdev/viz-dev-backend

# copy development environment
cp .env.dev .env

# run update
composer update

# generate key
php artisan key:generate

# create database.
# if database is already exist, skip to next command
su -c 'createdb vizdev' postgres || true

# run migration
php artisan migrate

# start php-fpm
php-fpm7

# start nginx
(nginx &)

while true; do
    read -p "UP!" temp
done
