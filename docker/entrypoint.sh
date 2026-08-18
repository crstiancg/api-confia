#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php artisan key:generate --show)
fi

php artisan config:clear
php artisan migrate --force

exec "$@"
