# Utiliser l'image PHP avec Apache
FROM php:8.1-apache

# Copier les fichiers de l'application
COPY . /var/www/html/

# Installer les extensions PHP nécessaires (par exemple : mysqli pour MySQL)
RUN docker-php-ext-install mysqli

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer le serveur Apache
CMD ["apache2-foreground"]
