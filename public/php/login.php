<?php
header('Content-Type: application/json');

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];
$userType = $data['userType'];

// Connexion à la base de données
$host = 'localhost'; // Remplace par ton hôte
$dbname = 'arcadia'; // Remplace par le nom de ta base de données
$dbuser = 'Admin'; // Remplace par ton nom d'utilisateur de base de données
$dbpass = 'AG)pbce]/mAzm5Fg'; // Remplace par ton mot de passe de base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $success = false;
    $message = '';

    // Vérifier les identifiants pour l'admin
    if ($userType === 'admin') {
        // Préparer la requête pour éviter les injections SQL
        $stmt = $pdo->prepare("SELECT * FROM administrators WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier si l'utilisateur existe
        if ($user) {
            // Vérifie le mot de passe (en supposant que tu utilises un hachage)
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
