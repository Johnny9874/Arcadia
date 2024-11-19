FROM node:16

# Définir le répertoire de travail dans le conteneur
WORKDIR /usr/src/app

# Copier les fichiers package.json et package-lock.json dans le conteneur
COPY package*.json ./

# Installer les dépendances
RUN npm install

# Copier tout le projet dans le conteneur
COPY . .

# Exposer le port 3000
EXPOSE 3000

# Lancer l'application
CMD ["node", "app.js"]

