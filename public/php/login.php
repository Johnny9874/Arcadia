<?php 
// Paramètres de connexion à la base de données
$host = 'localhost'; 
$dbname = 'arcadia'; 
$dbuser = 'Admin'; 
$dbpass = 'AG)pbce]/mAzm5Fg';

try {
    // Création d'une connexion PDO à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
    exit();
}

// Définir l'en-tête Content-Type pour indiquer que la réponse est au format JSON
header("Content-Type: application/json");

// Vérifier que la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Décoder le JSON reçu
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $password = $data['password'];
    $userType = $data['userType'];

    // Vérifier que les champs utilisateur et mot de passe ne sont pas vides
    if (!empty($username) && !empty($password)) {
        if ($userType === 'admin') {
            // Recherche dans la table administrators
            $req = $pdo->prepare("SELECT * FROM administrators WHERE username = :username");
        } elseif ($userType === 'employee') {
            // Recherche dans la table employees
            $req = $pdo->prepare("SELECT * FROM employees WHERE username = :username");
        } else {
            echo json_encode(["error" => "Type d'utilisateur invalide"]);
            exit();
        }

        $req->execute(['username' => $username]);
        $rep = $req->fetch();

        if ($rep && password_verify($password, $rep['password'])) {
            // Connexion réussie
            echo json_encode([
                "success" => true,
                "userType" => $userType
            ]);
        } else {
            // Identifiants incorrects
            echo json_encode(["error" => "Nom d'utilisateur ou mot de passe incorrect"]);
        }
    } else {
        echo json_encode(["error" => "Les champs utilisateur et mot de passe sont obligatoires"]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée"]);
}
?>

