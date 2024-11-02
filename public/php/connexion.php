<?php
session_start();
// Connexion à la base de données
$host = 'localhost';
$dbname = 'Arcadia';
$username = 'Admin';
$password = 'AG)pbce]/mAzm5Fg';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$mot_de_passe = $_POST['mot_de_passe'];
$role = $_POST['role'];

if ($role === "employee") {
    $sql = "SELECT * FROM employe WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $employe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employe && password_verify($mot_de_passe, $employe['mot_de_passe'])) {
        $_SESSION['employe_id'] = $employe['id'];
        header("Location: Page_Employe.html"); // Redirection pour les employés
        exit;
    } else {
        echo "Identifiants incorrects pour l'employé.";
    }
}
?>
