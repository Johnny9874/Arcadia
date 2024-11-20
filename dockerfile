# Étape 1 : Utiliser une image de base qui inclut Node.js et PHP
FROM node:16

# Installer PHP et Apache
RUN apt-get update && apt-get install -y \
    apache2 \
    php libapache2-mod-php

# Définir le répertoire de travail dans le conteneur
WORKDIR /usr/src/app

# Copier les fichiers package.json et package-lock.json dans le conteneur
COPY package*.json ./

# Installer les dépendances Node.js
RUN npm install

# Copier tout le projet dans le conteneur
COPY . .

# Configurer Apache pour servir les fichiers PHP
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
RUN service apache2 start

# Exposer le port 80 pour HTTP
EXPOSE 80

# Lancer Apache et l'application Node.js
CMD service apache2 start && node app.js


