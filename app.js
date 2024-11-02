const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const path = require('path'); // Importer le module path

const app = express();
const port = 3000;

// Middleware pour traiter le corps des requêtes
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Configuration de la session
app.use(session({
    secret: 'ton_secret', // Choisis un secret fort
    resave: false,
    saveUninitialized: true,
    cookie: { secure: false } // Mettre à true en production (HTTPS)
}));

// Servir les fichiers statiques à partir du dossier public
app.use(express.static(path.join(__dirname, 'public'))); // <-- Ajoute cette ligne

// Informations de connexion de l'admin
const adminCredentials = {
    username: 'Admin',
    password: 'AG)pbce]/mAzm5Fg',
};

// Middleware pour vérifier l'authentification
function checkAuth(req, res, next) {
    if (req.session.isAuthenticated) {
        return next();
    }
    res.status(401).send({ success: false, message: 'Accès refusé. Vous devez vous connecter.' });
}

// Route pour gérer la connexion
app.post('/login', (req, res) => {
    const { username, password, userType } = req.body;

    if (userType === 'admin') {
        if (username === adminCredentials.username && password === adminCredentials.password) {
            req.session.isAuthenticated = true; // Définit la session comme authentifiée
            return res.send({ success: true, message: "Connexion réussie !" });
        } else {
            return res.send({ success: false, message: 'Identifiants invalides.' });
        }
    }

    res.send({ success: false, message: 'Identifiants invalides.' });
});

// Route protégée pour l'administrateur
app.get('/admin/dashboard', checkAuth, (req, res) => {
    res.send({ success: true, message: 'Bienvenue sur le tableau de bord de l\'admin !' });
});

// Route pour afficher la page de connexion
app.get('/Page_Connexion.html', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'Page_Connexion.html'));
});


// Lancer le serveur
app.listen(port, () => {
    console.log(`Serveur en cours d'exécution à http://localhost:${port}`);
});