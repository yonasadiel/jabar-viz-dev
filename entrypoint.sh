#!/bin/ash

# exit immediately if one of commands fails
set -e

####### Backend Configuration #######
cd /home/vizdev/viz-dev-backend
chmod 777 -R /home/vizdev/viz-dev-backend/storage

su -c 'postgres -D /home/vizdev/dbdata &' postgres
timer="5"
until su -c 'pg_isready' postgres 2>/dev/null; do
  >&2 echo "Postgres is unavailable - sleeping for $timer seconds"
  sleep $timer
done
for f in /docker-entrypoint-initdb.d/*; do
        case "$f" in
            *.sh)  echo "$0: running $f"; . "$f" ;;
            *.sql) echo "$0: running $f"; psql --username "postgres" < "$f" && echo ;;
            *)     echo "$0: ignoring $f" ;;
        esac
        echo
done

cp .env.dev .env

composer clear-cache
composer install

php artisan key:generate
php artisan migrate

php-fpm7
nginx &

####### Frontend Configuration #######
cd /home/vizdev/viz-dev-frontend

yarn install
yarn run serve &

chown -R vizdev:vizdev node_modules

cd ..

/bin/ash
