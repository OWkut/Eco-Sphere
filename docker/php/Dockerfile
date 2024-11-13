# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Mettre à jour et installer les dépendances nécessaires pour GD
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Définir un ServerName pour éviter les erreurs Apache
RUN echo "ServerName eco-sphere.3il.fr" >> /etc/apache2/apache2.conf

# Activer les modules nécessaires
RUN a2enmod rewrite

# Exposer le port 80 (non sécurisé)
EXPOSE 443

# Redémarrer Apache
CMD ["apache2-foreground"]
