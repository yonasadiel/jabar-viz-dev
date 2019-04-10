#!/bin/ash

# exit immediately if one of commands fails
set -e

####### Backend Configuration #######
cd /home/vizdev/viz-dev-backend

# start postgresql
su -c 'postgres -D /home/vizdev/dbdata &' postgres
# copy development environment
cp .env.dev .env
# install composer dependencies
composer clear-cache
composer update

# run postgres initdb
# su -c "createdb vizdev" postgres || true
for f in /docker-entrypoint-initdb.d/*; do
        case "$f" in
            *.sh)  echo "$0: running $f"; . "$f" ;;
            *.sql) echo "$0: running $f"; psql --username "postgres" < "$f" && echo ;;
            *)     echo "$0: ignoring $f" ;;
        esac
        echo
done

# generate key
php artisan key:generate
# run migration
php artisan migrate
# start php-fpm
php-fpm7
# start nginx
nginx &

composer dump-autoload
php artisan db:seed

####### Frontend Configuration #######
cd /home/vizdev/viz-dev-frontend

# install configuration
yarn install
# serve frontend
yarn run serve &

while true; do
    read -p "UP!" temp
done
