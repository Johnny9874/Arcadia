<?php
session_start();
// Connexion à la base de données
$host = 'localhost';
$dbname = 'Arcadia';
$dbuser = 'Employé';
$dbpass = 'YfcePqQ3BkTEK!SB';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
    exit();
}

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $password = $data['password'];

    if ($username != "" && $password != "") {
        $req = $pdo->prepare("SELECT * FROM employé WHERE email = :username");
        $req->execute(['username' => $username]);
        $rep = $req->fetch();

        if ($rep && password_verify($password, $rep['password'])) {
            echo json_encode(["success" => "Connexion réussie"]);
        } else {
            echo json_encode(["error" => "Nom d'utilisateur ou mot de passe incorrect"]);
        }
    }
}
?>