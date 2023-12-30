<?php
include_once('../parametres/configurations.php');
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

            <?php
            $utilisateur = new Utilisateur();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['adresse_email'];
                $password = $_POST['mot_de_passe'];

                // Vérification des informations d'authentification
                $utilisateurData = $utilisateur->login($email);

                if ($utilisateurData && verifyPassword($password, $utilisateurData['mdp_utilisateur']) && verifyEmail($email, $utilisateurData['email_utilisateur'])) {
                    // Authentification réussie
                    $_SESSION['idUser'] = $utilisateurData['id_utilisateur'];

                    // Obtention de l'ID de l'utilisateur
                    $idUtilisateur = $utilisateur->getIdUtilisateur("email_utilisateur = '".$email."'");

                    echo 'Authentification réussie. Redirection vers la page d\'accueil...';
                    header('Location : ../index.php');
                } else {
                    // Authentification échouée
                    $errorMessage = 'Erreur : identifiant ou mot de passe incorrect.';
                }
            }
            ?>

            <?php if (isset($errorMessage)) : ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </section>
    </main>
    <?php include "../includes/footer.php";?>
</body>
</html>

