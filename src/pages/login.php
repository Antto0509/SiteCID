<?php
include_once('../parametres/configurations.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['adresse_email'];
    $password = $_POST['mot_de_passe'];

    // Récupération des informations de l'utilisateur depuis la base de données
    $user = get_result("SELECT * FROM Utilisateur WHERE email_utilisateur = '$email'");

    if ($user) {
        // Déchiffrement du mot de passe stocké
        $decryptedPassword = decryptPassword($user['mdp_utilisateur'], 'private.pem');

        // Vérification du mot de passe
        if ($password === $decryptedPassword) {
            // Mot de passe correct, effectuez les actions nécessaires pour la connexion réussie
            // ...

            // Redirection vers une page de succès ou autre action
            // header('Location: '.$successPage);
            exit();
        }
    }

    $errorMessage = "Erreur : identifiant ou mot de passe incorrect";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLSITEWEB ?>/css/connection.css">
    <title>Connexion - Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <!-- Page de connexion (identifiants ou e-mail + mdp) -->
    <?php include "../includes/header.php";?>

    <main class="conteneur-connexion">
        <header class="titre-connexion">
            <p>Se connecter</p>
        </header>
        <section class="saisie-infos-connexion">
            <form action="" method="post">
                <div class="groupe-input">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="adresse_email">
                </div>

                <div class="groupe-input">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mot_de_passe">
                    <a href="#" class="mot-de-passe-oubli">Mot de passe oublié</a>
                </div>
                <button type="submit">Connexion</button>
            </form>
            <div class="texte-connexion">
                <p>Pas de compte ? <a href="<?php echo PAGES_PATH ?>/register.php">Créer un compte</a></p>
            </div>
            <?php if (isset($errorMessage)) : ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </section>
    </main>
    <?php include "../includes/footer.php";?>
</body>
</html>

