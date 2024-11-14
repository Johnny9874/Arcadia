<?php
session_start();
// Connexion à la base de données
$host = 'localhost';
$dbname = 'Arcadia';
$username = 'Employé';
$password = 'YfcePqQ3BkTEK!SB';

try {
    // Création d'une connexion PDO à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définit le mode d'erreur en tant qu'exception
} catch (PDOException $e) {
     // En cas d'erreur de connexion, renvoyer un message d'erreur en JSON et arrêter le script
    echo json_encode(["error" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
    exit();
}  

// Définir l'en-tête Content-Type pour indiquer que la réponse est au format JSON
header("Content-Type: application/json");

// Vérifier que la méthode de requête est POST, car les identifiants sont envoyés via une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Décoder le JSON reçu dans le corps de la requête pour obtenir les données de connexion
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $password = $data['password'];

    // Vérifier que les champs utilisateur et mot de passe ne sont pas vides
    if ($username != "" && $password != "") {
        // Préparer une requête pour rechercher l'utilisateur dans la base de données
        $req = $pdo->prepare("SELECT * FROM employé WHERE username = :username");
        $req->execute(['username' => $username]);
        $rep = $req->fetch();

        // Vérifier que l'utilisateur existe et que le mot de passe est correct
        if ($rep && password_verify($password, $rep['password'])) {
            // Si la connexion est réussie, renvoyer un message de succès en JSON
            echo json_encode(["success" => "Connexion réussie"]);
        } else {
            // Si les identifiants sont incorrects, renvoyer un message d'erreur en JSON
            echo json_encode(["error" => "Nom d'utilisateur ou mot de passe incorrect"]);
        }
    }
}
?>

