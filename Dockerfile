### Step 1: Node.js for frontend (Vite)
FROM node:20 AS node-builder

WORKDIR /app

# Install build tools
RUN apt-get update && apt-get install -y python3 make g++ && rm -rf /var/lib/apt/lists/*

# Copy only package files first for caching
COPY package*.json ./
RUN npm install

# Now copy the rest and build
COPY . .
ENV NODE_ENV=production
RUN npm run build


### Step 2: PHP for Laravel backend
FROM php:8.2-fpm

WORKDIR /var/www

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel application
COPY --chown=www-data:www-data . /var/www

# Copy built frontend assets
COPY --from=node-builder /app/public/build /var/www/public/build
COPY --from=node-builder /app/public/mix-manifest.json /var/www/public/mix-manifest.json
COPY --from=node-builder /app/public/hot /var/www/public/hot # optional

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions and generate env key
COPY .env.example .env
RUN php artisan key:generate

# Create SQLite db
RUN mkdir -p database && touch database/database.sqlite

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8000
