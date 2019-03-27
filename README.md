# JABAR-VIZ-DEV

## Requirement

* Docker

## Setup

    docker build . --build-arg http_proxy="http://167.205.22.102:8800" -t viz-dev

## Run

    docker run --mount src=$(pwd)/viz-dev-backend,target=/home/vizdev/viz-dev-backend,type=bind -p 80:80 -it

This might take a while. Wait until `UP!` is appear in your terminal.
