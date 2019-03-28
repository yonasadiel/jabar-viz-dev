# JABAR-VIZ-DEV

## Requirement

* Docker

## Setup

Build the image:

    docker build . -t viz-dev

or with proxy:

    docker build . --build-arg http_proxy="http://167.205.22.102:8800" -t viz-dev

Create volume:

    docker volume create viz-dev-dbdata

## Run

    docker container kill $(docker container ls --quiet)
    docker run \
        --mount src=$(pwd)/viz-dev-backend,target=/home/vizdev/viz-dev-backend,type=bind \
        --mount src=viz-dev-dbdata,target=/home/vizdev/dbdata,type=bind \
        -p 80:80 \
        -it viz-dev

This might take a while. Wait until `UP!` is appear in your terminal.
