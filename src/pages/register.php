<?php
include_once('../parametres/configurations.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $civiliteMonsieur = isset($_POST['monsieur']) ? $_POST['monsieur'] : false;
    $civiliteMadame = isset($_POST['madame']) ? $_POST['madame'] : false;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $promotion = $_POST['promotion'];
    $emploi = $_POST['emploi'];
    $ville = $_POST['ville'];
    $email = $_POST['adresse_email'];
    $password = $_POST['mot_de_passe'];
    $confPassword = $_POST['conf_mot_de_passe'];
    $politiqueConfidentialite = isset($_POST['politique_confidentialite']) ? $_POST['politique_confidentialite'] : false;

    // Validation des données (ajoutez votre propre logique de validation)

    // Vérification du mot de passe et de sa confirmation
    if ($password !== $confPassword) {
        $errorMessage = "Erreur : les mots de passe ne correspondent pas.";
    } elseif (!$politiqueConfidentialite) {
        $errorMessage = "Erreur : veuillez adhérer à la politique de confidentialité.";
    } else {
        // Chiffrer le mot de passe avant de le stocker dans la base de données
        $encryptedPassword = encryptPassword($password, 'public.pem');

        // Insérer les données dans la base de données
        $insertValues = array(
            'nom_utilisateur' => $nom,
            'prenom_utilisateur' => $prenom,
            'email_utilisateur' => $email,
            'mdp_utilisateur' => $encryptedPassword,
            'date_naissance_utilisateur' => $promotion,
            'emploi_utilisateur' => $emploi,
            'id_adresse' => null, // Remplacez par la valeur appropriée
            'id_genre' => null, // Remplacez par la valeur appropriée
            'id_promotion' => null, // Remplacez par la valeur appropriée
            'id_role' => null // Remplacez par la valeur appropriée
        );

        if (set_insert('Utilisateur', $insertValues, 1)) {
            // Inscription réussie, redirigez vers une page de succès ou autre action
            // header('Location: '.$successPage);
            exit();
        } else {
            // Erreur lors de l'insertion dans la base de données
            $errorMessage = "Erreur : problème lors de l'inscription.";
        }
    }
}
?>

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
                        <input type="checkbox" id="monsieur" name="monsieur">
                    </div>

                    <div class="groupe-input">
                        <label for="madame">Mme</label>
                        <input type="checkbox" id="madame" name="madame">
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
            <?php if (isset($errorMessage)) : ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </section>
    </main>
    
    <?php include "../includes/footer.php";?>
</body>
</html>