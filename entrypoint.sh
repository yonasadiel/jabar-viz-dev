#!/bin/ash

# exit immediately if one of commands fails
set -e

####### Backend Configuration #######
cd /home/vizdev/viz-dev-backend

# start postgresql
su -c 'postgres -D /home/vizdev/dbdata &' postgres
# copy development environment
cp .env.dev .env
# run update
composer update
# generate key
php artisan key:generate
# create database.
# assuming the postgres already running
# if database is already exist, skip to next command
su -c 'createdb vizdev' postgres || true
# run migration
php artisan migrate
# start php-fpm
php-fpm7
# start nginx
nginx &

####### Frontend Configuration #######
cd /home/vizdev/viz-dev-frontend

# install configuration
yarn install
# serve frontend
yarn run serve &

while true; do
    read -p "UP!" temp
done
