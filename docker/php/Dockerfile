# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Activer les modules Apache et PHP nécessaires
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Activer mod_rewrite pour les URL propres (facultatif)
RUN a2enmod rewrite

# Copier le code PHP dans le répertoire public de Apache
COPY ./src /var/www/html/

# Exposer le port 80 (par défaut pour Apache)
EXPOSE 80