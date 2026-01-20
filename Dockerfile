# Stage 1 - Build Frontend (Vite)
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Composer + Apache)
FROM php:8.2-apache AS backend

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql mbstring zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app files
COPY . .

# Copy built frontend from Stage 1 (default Vite output is /public/build)
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-cache

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 755 /var/www/html/storage

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
