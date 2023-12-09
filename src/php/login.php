<?php //require('../../includes/pdo.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connection.css">
    <title>Connexion - Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <!-- Page de connexion (identifiants ou e-mail + mdp) -->
    <?php include "header.php"?>
    <main class="conteneur-connexion">
        <header class="titre-connexion">
            <p>Se connecter</p>
        </header>
        <section class="saisie-infos-connexion">
            <form action="" method="post">
                <div class="groupe-input">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" id="identifiant" name="adresse_email">
                </div>

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
        </section>
    </main>
    <?php include "footer.php"?>
</body>
</html>

