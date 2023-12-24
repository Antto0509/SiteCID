<?php //require('../../../../includes/pdo.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connection.css">
    <script src="../script/js/register.js"></script>
    <title>Inscription - Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <!-- Page d'inscription -->
    <?php include "../includes/header.php";?>

    <main class="conteneur-connexion">
        <header class="titre-connexion">
            <p>S'inscrire</p>
        </header>
        <section class="saisie-infos-connexion">
            <form action="" method="post">
                <div class="groupe-civilite">
                    <div class="groupe-input">
                        <label for="monsieur">M.</label>
                        <input type="checkbox" id="monsieur" name="monsieur" value="1">
                    </div>

                    <div class="groupe-input">
                        <label for="madame">Mme</label>
                        <input type="checkbox" id="madame" name="madame" value="1">
                    </div>
                </div>

                <div class="groupe-input">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom">
                </div>

                <div class="groupe-input">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom">
                </div>

                <div class="groupe-input">
                    <label for="promotion">Année de promotion</label>
                    <input type="date" id="promotion" name="promotion">
                </div>

                <div class="groupe-input">
                    <label for="emploi">Emploi (facultatif)</label>
                    <input type="text" id="emploi" name="emploi">
                </div>

                <div class="groupe-input">
                    <label for="ville">Ville de résidence (facultatif)</label>
                    <input type="text" id="ville" name="ville">
                </div>

                <div class="groupe-input">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="adresse_email">
                </div>

                <div class="groupe-input">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mot_de_passe">
                </div>

                <div class="groupe-input">
                    <label for="conf_mdp">Confirmer le mot de passe</label>
                    <input type="password" id="conf_mdp" name="conf_mot_de_passe">
                </div>

                <div class="groupe-input">
                    <label for="politique_confidentialite">J'adhère à la politique de confidentialité</label>
                    <input type="checkbox" id="politique_confidentialite" name="politique_confidentialite">
                </div>  
                <button type="submit">Inscription</button>
            </form>
            <div class="texte-connexion">
                <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
            </div>
        </section>
    </main>
    
    <?php include "../includes/footer.php";?>
</body>
</html>