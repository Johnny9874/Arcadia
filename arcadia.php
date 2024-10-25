<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifiez que la méthode est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost"; // Serveur local
    $username = "root"; // Nom d'utilisateur
    $password = ""; // Mot de passe
    $dbname = "arcadia"; // Nom de la base de données

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Tester la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Préparer et lier
    $stmt = $conn->prepare("INSERT INTO contacts (nom, prenom, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $message);

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Nouveau message enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement : " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo "Méthode non autorisée.";
}
?>