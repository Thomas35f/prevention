FROM php:8.2-apache

# MAJ système + dépendances
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zip \
    unzip \
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_mysql

# Activation des modules Apache nécessaires
RUN a2enmod rewrite

# Configuration d'Apache
COPY docker/server-api.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

# Installez Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer self-update

# Installez les dépendances de Laravel
RUN composer install

COPY .env.example .env

RUN php artisan key:generate

RUN mkdir /var/www/html/storage
RUN mkdir /var/www/html/storage/framework
RUN mkdir /var/www/html/storage/framework/sessions
RUN mkdir /var/www/html/storage/framework/cache
RUN mkdir /var/www/html/storage/framework/views

# Donner les permissions nécessaires aux répertoires de stockage
RUN chown -R www-data:www-data /var/www/html/storage


ENV DB_CONNECTION=mysql
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=prevention
ENV DB_USERNAME=thomas
ENV DB_PASSWORD=My7Pass@Word_9_8A_zE

# Installation du front
RUN npm install -g vite
RUN npm install

# Build du front - Voir note dans le readme
RUN npm run build

EXPOSE 80

CMD ["apache2-foreground"]
