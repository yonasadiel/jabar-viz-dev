# JABAR-VIZ-DEV

## Setup

Build the image:

    docker build . -t viz-dev

or with proxy:

    docker build . --build-arg http_proxy="http://167.205.22.102:8800" -t viz-dev

Create volume:

    docker volume create viz-dev-dbdata

## Run

    docker run \
        --mount src=$(pwd)/viz-dev-backend,target=/home/vizdev/viz-dev-backend,type=bind \
        --mount src=$(pwd)/viz-dev-frontend,target=/home/vizdev/viz-dev-frontend,type=bind \
        -v viz-dev-dbdata:/home/vizdev/dbdata \
        -p 80:8080 \
        -p 8000:80 \
        -it viz-dev

This might take a while. Wait until `UP!` is appear in your terminal.

To spawn a terminal inside docker:

    docker exec -it $(docker container ls --quiet) /bin/sh
