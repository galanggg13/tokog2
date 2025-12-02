#!/usr/bin/env bash
set -e

echo "========================================"
echo " RUNNING MIGRATIONS ON RAILWAY"
echo "========================================"

php artisan migrate --force

echo "========================================"
echo " MIGRATIONS DONE"
echo "========================================"

# start frankenphp
php -S 0.0.0.0:8000 -t public
