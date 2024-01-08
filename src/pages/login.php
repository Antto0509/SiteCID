<?php
include_once('../parametres/configurations.php');

$privateKey = openssl_pkey_get_private($_SESSION['private_key']);
$utilisateur = new Utilisateur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['adresse_email'];
        $password = $_POST['mot_de_passe'];

        // Vérification des informations d'authentification
        $utilisateurData = $utilisateur->login($email);

        if ($utilisateurData && verifyInput($password, $utilisateurData['mdp_utilisateur'], $privateKey) && verifyInput($email, $utilisateurData['email_utilisateur'], $privateKey)) {
            // Stocker des informations dans la session
            $_SESSION['user_id'] = $utilisateurData['id_utilisateur'];
            $_SESSION['user_email'] = $utilisateurData['email_utilisateur'];

            // Construire l'URL de redirection vers la page personnelle de l'utilisateur
            $redirectUrl = 'http://176.223.137.210/SiteCID/src/pages/infoUser.php?id=' . $utilisateurData['id_utilisateur'];

            // Rediriger vers la page personnelle de l'utilisateur
            header('Location: ' . $redirectUrl);
            exit();
        } else {
            // Authentification échouée
            throw new Exception('Identifiant ou mot de passe incorrect.');
        }
    } catch (Exception $e) {
        $errorMessage = 'Erreur : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connection.css">
    <title>Connexion - Cercle des Informaticiens Dispersés</title>
</head>
<body>
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
                <p>Pas de compte ? <a href="register.php">Créer un compte</a></p>
            </div>

            <?php if (isset($errorMessage)) : ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </section>
    </main>
    <?php include "../includes/footer.php";?>
</body>
</html>

