#!/bin/sh
set -eu
# Render generates 32 random bytes as base64; Laravel requires this prefix.
if [ -n "${RENDER_APP_KEY:-}" ]; then
    export APP_KEY="base64:${RENDER_APP_KEY}"
fi
: "${APP_KEY:?Set APP_KEY or RENDER_APP_KEY in Render environment variables}"
if [ -n "${RENDER_EXTERNAL_URL:-}" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi
port="${PORT:-10000}"
case "$port" in
    ''|*[!0-9]*) echo 'PORT must be numeric' >&2; exit 1 ;;
esac
sed -ri "s/^Listen [0-9]+$/Listen ${port}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${port}>/" /etc/apache2/sites-available/000-default.conf
php artisan config:cache
php artisan migrate --force
php artisan view:cache
exec apache2-foreground
