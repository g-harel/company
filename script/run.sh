#!/bin/sh

CONTAINER_NAME=xampp
PORT=41062
HOST=localhost
DIR=www

docker rm -f $CONTAINER_NAME >/dev/null 2>&1

docker run                        \
    --detach                      \
    --name $CONTAINER_NAME        \
    --publish $PORT:80            \
    --volume $(pwd)/company:/$DIR \
    tomsik68/xampp

echo "website:    http://$HOST:$PORT/$DIR/"
echo "phpmyadmin: http://$HOST:$PORT/phpmyadmin/"
