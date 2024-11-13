# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Mettre à jour et installer les dépendances nécessaires pour SSL et GD
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    openssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd



# Exposer le port 443
EXPOSE 443

# Redémarrer Apache
CMD ["apache2-foreground"]
