#!/bin/sh
# Docker compose init script - not for production

if [[ ! -L public/storage ]]; then
  php artisan storage:link
fi

if [[ ! -d vendor ]]; then
  composer install 
fi

if [[ ! -f .env ]]; then
  cp .env.example .env
  php artisan key:generate
fi

until php artisan tinker --execute "dd(DB::connection()->getPdo())" | grep -q "CONNECTION_STATUS"; do
  echo "Init: Waiting for database connection..."
  sleep 1
done

php artisan tinker --execute "DB::statement('CREATE DATABASE IF NOT EXISTS tests;')"

if php artisan tinker --execute "dd(Schema::hasTable('migrations'))" | grep -q "false"; then
  php artisan migrate:fresh --seed
fi

php artisan serve --host 0.0.0.0