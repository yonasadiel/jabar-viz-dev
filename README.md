# JABAR-VIZ-DEV

## Requirement

* Docker

## Setup

1. Build the image. To use behind proxy:

    docker build . --build-arg http_proxy="http://167.205.22.102:8800" -t viz-dev

2. Install composer

    docker run --mount src=$(pwd)/viz-dev-backend,target=/home/vizdev/viz-dev-backend,type=bind -p 80:80 -it viz-dev
    docker exec -u root -it $(docker container ls --quiet) /bin/sh
    cd /home/vizdev/viz-dev-backend
    composer update
    php artisan key:generate

## Run

    docker run --mount src=$(pwd)/viz-dev-backend,target=/home/vizdev/viz-dev-backend,type=bind -p 80:80 -it

