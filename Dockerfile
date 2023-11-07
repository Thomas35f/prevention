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

# Installez le paquet PHP MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

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

# Générez le fichier .env
COPY .env.example .env

# Générez la clé d'application Laravel
RUN php artisan key:generate

# Créer les répertoires nécessaires au fonctionnement du framework
RUN mkdir /var/www/html/storage
RUN mkdir /var/www/html/storage/framework
RUN mkdir /var/www/html/storage/framework/sessions
RUN mkdir /var/www/html/storage/framework/cache
RUN mkdir /var/www/html/storage/framework/views
# Donner les permissions nécessaires aux répertoires de stockage
RUN chown -R www-data:www-data /var/www/html/storage

# Définissez les paramètres de connexion à la base de données
ENV DB_CONNECTION=mysql
# "db" est le nom du service de la base de données défini dans le docker-compose.yml
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=prevention
ENV DB_USERNAME=thomas
ENV DB_PASSWORD=My7Pass@Word_9_8A_zE

# Installation du front
RUN npm install -g vite
RUN npm install

# Build du front
RUN npm run build

# Exposez le port 80
EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]
