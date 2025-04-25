#!/bin/sh

# Set proper permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Create symbolic link for storage
php artisan storage:link || true

exec php-fpm
