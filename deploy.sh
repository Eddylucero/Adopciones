#!/bin/bash

echo "🚀 Iniciando deploy de Laravel 12 en Railway..."

# 1️⃣ Instalar dependencias (producción)
echo "📦 Instalando dependencias..."
composer install --no-dev --optimize-autoloader

# 2️⃣ Limpieza de cache
echo "🧹 Limpiando cache de config, routes, views y app..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 3️⃣ Cachear rutas y config
echo "⚡ Cacheando rutas y config..."
php artisan route:cache
php artisan config:cache

# 4️⃣ Migraciones y seeders
echo "🗄 Ejecutando migraciones y seeders..."
php artisan migrate --force
php artisan db:seed --force

# 5️⃣ Crear enlaces simbólicos para storage
echo "🔗 Creando storage link..."
php artisan storage:link || echo "🔹 Storage link ya existe"

# 6️⃣ Asegurar permisos de storage
echo "🔒 Ajustando permisos en storage/framework..."
mkdir -p storage/framework/sessions
chmod -R 775 storage

echo "✅ Deploy completado con éxito!"
