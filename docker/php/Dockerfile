# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Mettre à jour et installer les dépendances nécessaires pour SSL et GD
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    openssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

RUN echo "ServerName eco-sphere.3il.fr" >> /etc/apache2/apache2.conf

# Activer les modules nécessaires
RUN a2enmod rewrite ssl

# Copier les fichiers SSL dans le conteneur (utiliser certificate.crt et private.key)
COPY ./ssl/certificate.crt /etc/ssl/certs/
COPY ./ssl/private.key /etc/ssl/private/

# Configurer Apache pour écouter sur le port 443 et activer SSL
RUN echo '<VirtualHost *:443>' > /etc/apache2/sites-available/default-ssl.conf && \
    echo '    SSLEngine on' >> /etc/apache2/sites-available/default-ssl.conf && \
    echo '    SSLCertificateFile /etc/ssl/certs/certificate.crt' >> /etc/apache2/sites-available/default-ssl.conf && \
    echo '    SSLCertificateKeyFile /etc/ssl/private/private.key' >> /etc/apache2/sites-available/default-ssl.conf && \
    echo '    DocumentRoot /var/www/html' >> /etc/apache2/sites-available/default-ssl.conf && \
    echo '</VirtualHost>' >> /etc/apache2/sites-available/default-ssl.conf

# Activer le site SSL
RUN a2ensite default-ssl.conf

# Exposer le port 443
EXPOSE 443

# Redémarrer Apache
CMD ["apache2-foreground"]
