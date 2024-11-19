Arcadia est une application web pour la gestion et l'amélioration de l'expérience visiteur du zoo Arcadia. Elle intègre Node.js, Express, EJS,Javascript, TailwindCSS, PostgreSQL, et MongoDB.

Prérequis
- Node.js et npm installés
- PostgreSQL installé localement
- Un compte Fly.io
- Flyctl installé
Pour le projet Arcadia, j'ai décidé d'utiliser plusieurs technologies pour répondre aux besoins variés de notre application. Voici comment j'ai configuré mon environnement de développement.

Pour commencer, j'ai choisi Visual Studio Code comme IDE. C'est un outil très populaire et puissant, avec plein de fonctionnalités et d'extensions qui facilitent la gestion du code, le débogage et l'intégration avec d'autres outils.

J'ai organisé mes dossiers de manière logique dans le dossier racine nommé Arcadia :

La structure de mon projet est organisée comme suit :

Arcadia/public/ : Fichiers statiques accessibles côté client
css/ : Fichiers CSS
js/ : Fichiers JavaScript côté client
html/ : Fichier HTML
images/ : Images utilisées dans l'application
Arcadia/sql/ : Scripts SQL pour la création des bases de données, des tables et l'intégration des données

Arcadia/app.js : Configure l'application

À la racine du dossier Arcadia, j'ai initialisé un nouveau projet Node.js avec npm en utilisant la commande npm init. Cela a créé un fichier package.json pour gérer toutes les dépendances du projet.

J'ai configuré PostgreSQL pour les données relationnelles et structurées en créant la base de donnée en utilisant CREATE DATABASE 'arcadia'.

Enfin, j'ai initialisé un dépôt Git à la racine du projet avec la commande git init. Cela me permet de suivre les modifications du code source. J'ai également connecté mon dépôt local à un dépôt distant sur GitHub en utilisant des commandes comme git remote add origin et git push -u origin main.



