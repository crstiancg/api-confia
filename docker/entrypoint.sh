#!/bin/sh
set -e

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php artisan key:generate --show)
fi

php artisan config:clear

echo "Esperando conexión a la base de datos ($DB_HOST:$DB_PORT)..."
attempt=0
until php artisan db:show > /dev/null 2>&1; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 30 ]; then
        echo "No se pudo conectar a la base de datos después de 30 intentos."
        exit 1
    fi
    sleep 2
done
echo "Base de datos disponible."

php artisan migrate --force

php artisan app:ensure-oauth-client
php artisan db:seed --class=AdminUserSeeder --force

exec "$@"
