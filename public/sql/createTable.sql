-- Creation de la table administrateurs
CREATE TABLE public.administrators (
    admin_id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Creation de la table employé 
CREATE TABLE public.employé (
    employé_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
);

CREATE TABLE public.avis (
    avis_id SERIAL PRIMARY KEY,
    chauffeur_id INT NOT NULL,
    passager_id INT NOT NULL,
    contenu TEXT NOT NULL,
    date_avis DATE NOT NULL,
    status BOOLEAN NOT NULL,
    note INT NOT NULL
);

CREATE TABLE public.contact (
    contact_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
);

CREATE TABLE public.covoiturages (
    id SERIAL PRIMARY KEY,
    chauffeur_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    passager_id VARCHAR(255) NOT NULL,
    date_depart DATE NOT NULL,
    date_arrivee TIME NOT NULL,
    lieu_depart TEXT NOT NULL,
    lieu_arrive TEXT NOT NULL,
    status TEXT NOT NULL,
    prix DECIMAL NOT NULL,
    est_ecologique BOOLEAN NOT NULL,
    places_disponibles INT NOT NULL
);

CREATE TABLE public.credits (
    id SERIAL PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    credit_actuels DECIMAL NOT NULL
);

CREATE TABLE public.participation (
    id SERIAL PRIMARY KEY,
    covoiturage_id INT NOT NULL,
    passager_id INT NOT NULL,
    status BOOLEAN NOT NULL,
    date_participation DATE NOT NULL,
    credit_utilise DECIMAL NOT NULL
);

CREATE TABLE public.preferences (
    id SERIAL PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    accepte_fumeur BOOLEAN NOT NULL,
    accepte_animaux BOOLEAN NOT NULL,
    preference_personnalisee TEXT NOT NULL
);

CREATE TABLE public.utilisateurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    date_creation DATE NOT NULL
);

CREATE TABLE public.vehicules (
    id SERIAL PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    plaque_immatriculation VARCHAR(255) NOT NULL,
    est_ecologique BOOLEAN NOT NULL,
    marque VARCHAR(255) NOT NULL,
    modele VARCHAR(255) NOT NULL,
    couleur VARCHAR(255) NOT NULL,
    nombre_places INT NOT NULL
);
