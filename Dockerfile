# Utilisez l'image officielle PHP avec Apache
FROM php:8.2-apache

# Mettez à jour le système et installez les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zip \
    unzip \
    nodejs \
    npm


# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration d'Apache
COPY docker/server-api.conf /etc/apache2/sites-available/000-default.conf
# Configurez le répertoire de travail
WORKDIR /var/www/html

# Copiez les fichiers de votre application Laravel dans le conteneur
COPY . .

# Installez Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Mettez à jour Composer
RUN composer self-update

# Installez les dépendances de Laravel
RUN composer install

COPY .env.example .env

# Générez la clé d'application Laravel
RUN php artisan key:generate

# Installation du front
RUN npm install -g vite

# Build du front
RUN npm run build

# Exposez le port 80
EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]
