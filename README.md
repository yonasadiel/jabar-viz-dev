# JABAR-VIZ-DEV

## Setup

Build the image:

    docker build . --rm -t viz-dev

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

This might take a while. After all script executed, bash will pop up.
