#!/bin/sh
chmod -R 777 storage
php artisan passport:keys
php artisan storage:link
