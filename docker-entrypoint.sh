#!/bin/sh

# Set proper permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Create symbolic link for storage
php artisan storage:link || true

# Build frontend
npm install
npm run build
rm -f public/hot

# Clear and cache Laravel stuff
php artisan config:clear && php artisan config:cache
php artisan route:clear && php artisan route:cache
php artisan view:clear && php artisan view:cache
php artisan optimize:clear && php artisan optimize
php artisan responsecache:clear

exec supervisord -c /etc/supervisord.conf
