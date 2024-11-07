<?php 
// Connexion à la base de données
$host = 'localhost'; 
$dbname = 'arcadia'; 
$dbuser = 'Admin'; 
$dbpass = 'AG)pbce]/mAzm5Fg';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Décoder le JSON reçu
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $password = $data['password'];

    if($username != "" && $password != "") {
        // Vérification des identifiants
        $req = $pdo->prepare("SELECT * FROM administrators WHERE username = :username AND password = :password");
        $req->execute(['username' => $username, 'password' => $password]);
        $rep = $req->fetch();

        if ($rep) {
            echo json_encode(["success" => "Connexion réussie"]);
            header("Location: dashboard.html");
            // Redirige côté client
        } else {
            echo json_encode(["error" => "Nom d'utilisateur ou mot de passe incorrect"]);
        }
    }
}
?>

