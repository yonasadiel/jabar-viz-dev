#!/bin/ash

# exit immediately if one of commands fails
set -e

####### Backend Configuration #######
cd /home/vizdev/viz-dev-backend
chmod 777 -R /home/vizdev/viz-dev-backend/storage

# start postgresql
su -c 'postgres -D /home/vizdev/dbdata &' postgres
timer="5"
until su -c 'pg_isready' postgres 2>/dev/null; do
  >&2 echo "Postgres is unavailable - sleeping for $timer seconds"
  sleep $timer
done
# run postgres initdb
for f in /docker-entrypoint-initdb.d/*; do
        case "$f" in
            *.sh)  echo "$0: running $f"; . "$f" ;;
            *.sql) echo "$0: running $f"; psql --username "postgres" < "$f" && echo ;;
            *)     echo "$0: ignoring $f" ;;
        esac
        echo
done

# copy development environment
cp .env.dev .env
# install composer dependencies
composer clear-cache
composer install

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

cd ..

/bin/ash
