<?php
// Connexion à la base de données
$host = 'localhost'; // Remplace par ton hôte
$dbname = 'Arcadia'; // Remplace par le nom de ta base de données
$dbuser = 'Admin'; // Remplace par ton nom d'utilisateur de base de données
$dbpass = 'AG)pbce]/mAzm5Fg'; // Remplace par ton mot de passe de base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Remplace 'tonNomDUtilisateur' et 'tonMotDePasseEnClair' par les valeurs souhaitées
    $username = 'Admin';
    $plainPassword = 'AG)pbce]/mAzm5Fg  '; // Mot de passe en clair

    // Hacher le mot de passe
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Préparer la requête d'insertion ou de mise à jour
    $stmt = $pdo->prepare("INSERT INTO administrators (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();

    echo "Administrateur créé avec succès !";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
