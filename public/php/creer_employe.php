    <?php
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
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $mot_de_passe = password_hash(trim($_POST['mot_de_passe']), PASSWORD_DEFAULT);

        // Insertion dans la table employé
        $sql = "INSERT INTO employe (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
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
    ?>
