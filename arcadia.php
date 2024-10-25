<?php
// la connexion à la base de donnée
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arcadia";

try {
    // Essaye de se connecter à la base de données
    $conn = new PDO("mysql:host=$servername;port=3308;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "La connexion a bien été établie";
} catch(PDOException $e) {
    // Affiche un message d'erreur si la connexion échoue
    echo "La connexion a échoué : " . $e->getMessage();
    $conn = null; // Définit $conn à null pour éviter d'utiliser une variable non initialisée
}

if (isset($_POST['envoyer'])) {
    // Vérifiez si la connexion a été établie avant d'exécuter la requête
    if ($conn) {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Préparation de la requête SQL
        $sql = "INSERT INTO `contacts` (`nom`, `prenom`, `email`, `message`) VALUES (:nom, :prenom, :email, :message)";
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Les données ont été ajoutées avec succès.";
        } else {
            echo "Une erreur est survenue lors de l'ajout des données.";
        }
    } else {
        echo "Erreur : Impossible de se connecter à la base de données.";
    }
}
?>