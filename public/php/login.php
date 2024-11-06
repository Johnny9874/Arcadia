<?php
header('Content-Type: application/json');

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true); // Décoder le JSON
$username = $data['username'] ?? null;
$password = $data['password'] ?? null;
$userType = $data['userType'] ?? null;

// Vérification des données
if (!$username || !$password || !$userType) {
    echo json_encode(['success' => false, 'message' => 'Données de connexion manquantes.']);
    exit;
}

// Connexion à la base de données
$host = 'localhost'; 
$dbname = 'arcadia'; 
$dbuser = 'Admin'; 
$dbpass = 'AG)pbce]/mAzm5Fg';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $success = false;
    $message = '';

    // Vérification des identifiants pour l'admin
    if ($userType === 'admin') {
        $stmt = $pdo->prepare("SELECT * FROM administrators WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $success = true;
                $message = 'Connexion réussie.';
            } else {
                $message = 'Mot de passe incorrect.';
            }
        } else {
            $message = 'Nom d’utilisateur admin non trouvé.';
        }
    } else {
        $message = 'Type d’utilisateur inconnu.';
    }

    echo json_encode(['success' => $success, 'message' => $message]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données: ' . $e->getMessage()]);
}
?>
