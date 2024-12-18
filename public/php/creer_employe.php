<<<<<<< HEAD
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'arcadia';
$username = 'Admin';
$password = 'AG)pbce]/mAzm5Fg';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie."; // Pour vérification
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mot_de_passe = password_hash(trim($_POST['mot_de_passe']), PASSWORD_DEFAULT);

    // Insertion dans la table employé
    $sql = "INSERT INTO employé (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe
        ]);
        echo "Compte employé créé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la création du compte employé : " . $e->getMessage();
    }
}
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

    // Vérification des données du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars(trim($_POST['nom']));
        $username = htmlspecialchars(trim($_POST['username']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

        // Insertion dans la table employé
        $sql = "INSERT INTO employé (nom, username, email, password) VALUES (:nom, :username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':nom' => $nom,
                ':username' => $username,
                ':email' => $email,
                ':password' => $password
            ]);
            echo "Compte employé créé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la création du compte employé : " . $e->getMessage();
        }
    }
    ?>
