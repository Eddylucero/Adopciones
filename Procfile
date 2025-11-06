release: php artisan migrate --force && php artisan db:seed --force

# Inicia el servidor web nativo de Railway (Apache/Nginx)
web: php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan cache:clear && vendor/bin/heroku-php-apache2 public/
