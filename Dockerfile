# Utiliser une image php8.2 ave apache comme base
FROM php:8.2-apache

# Mettre à jour les packages et installer les dépendances nécessaires
# libicu-dev est nécessaire pour compiler l'extension php-intl
# libonig-dev est nécessaire pour compiler l'extenstion php-mbstring
RUN apt-get update && apt-get install -y \
    software-properties-common \
    apt-transport-https \
    ca-certificates \
    libicu-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Installez l'extension bc-math
RUN docker-php-ext-install bcmath intl mbstring pdo pdo_mysql

# Ajouter le référentiel `ppa:ondrej/php`
#RUN add-apt-repository ppa:ondrej/php

# Mettre à jour les packages après l'ajout du référentiel
RUN apt-get update

# Installer PHP 8.2 et les extensions nécessaires
#RUN apt-get install -y
#   php8.2 \
#    php8.2-cli \
#    php8.2-mbstring \
#    php8.2-xml \
#    php8.2-curl \
#    php8.2-mysql \
#    php8.2-pdo \
#    php8.2-zip \
#    php8.2-gd \
#    php8.2-bcmath \
#    php8.2-redis \
#    php8.2-intl \
#    php8.2-imagick \
#    && rm -rf /var/lib/apt/lists/*

# Configuration supplémentaire de PHP (si nécessaire)
# COPY php.ini /etc/php/8.2/cli/php.ini

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration d'Apache
COPY docker/server-api.conf /etc/apache2/sites-available/000-default.conf

# Copier le code source de l'application Laravel
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Création d'un utilisateur sans privilège root pour exécuter composer
# Définition d'un utilisateur non privilégié
#RUN adduser --disabled-password --gecos "" appuser
USER www-data
# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Copier le fichier d'environnement
COPY .env.example .env

# Générer la clé d'application Laravel
USER root
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
ENV DB_DATABASE=dashcam
ENV DB_USERNAME=stephane
ENV DB_PASSWORD=My7Pass@Word_9_8A_zE

# Exposer le port 80 pour l'accès HTTP
EXPOSE 80

# Définir le point d'entrée pour l'exécution du serveur Apache
CMD ["apache2-foreground"]
