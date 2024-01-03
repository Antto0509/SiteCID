<?php
include_once('../parametres/configurations.php');

$utilisateur = new Utilisateur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['adresse_email'];
        $password = $_POST['mot_de_passe'];
        $emploi = $_POST['emploi'];

        // Vérifier si les champs obligatoires sont renseignés
        $champsObligatoires = array('nom', 'prenom', 'adresse_email', 'mot_de_passe', 'conf_mot_de_passe');
        foreach ($champsObligatoires as $champ) {
            if (empty($_POST[$champ])) {
                throw new Exception('Veuillez remplir tous les champs obligatoires.');
            }
        }

        // Vérifier la correspondance des mots de passe
        if ($_POST['mot_de_passe'] !== $_POST['conf_mot_de_passe']) {
            throw new Exception('Les mots de passe ne correspondent pas.');
        }

        // Vérifier l'adhésion à la politique de confidentialité
        if (!isset($_POST['politique_confidentialite'])) {
            throw new Exception('Veuillez adhérer à la politique de confidentialité pour vous inscrire.');
        }

        $idGenre = isset($_POST['monsieur']) ? 'monsieur' : (isset($_POST['madame']) ? 'madame' : '');

        // Récupérer l'année de promotion sélectionnée
        $annee_promotion = $_POST['annee_promotion'];

        $customUserId = $utilisateur->generateCustomUserId($nom, $prenom);

        // Ajout d'un nouvel utilisateur avec le mot de passe chiffré et l'année de promotion
        $result = $utilisateur->addUtilisateur($nom, $prenom, $email, $password, $emploi, $idGenre, $annee_promotion);

        // Récupérer la ville si elle est saisie
        $ville = isset($_POST['ville']) ? $_POST['ville'] : null;

        // Ajouter la ville dans la table Ville si elle est saisie
        if (!empty($ville)) {
            $valuesVille = array(
                'nom_ville' => $ville,
            );
            set_insert('Ville', $valuesVille);
        }

        if (!$result)
            throw new Exception('Erreur lors de l\'inscription.');
        else {
            header('Location : http://176.223.137.210/SiteCID/src/pages/login.php');
            exit();
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
                    <label for="annee_promotion">Année de promotion</label>
                    <select id="annee_promotion" name="annee_promotion">
                        <?php
                        // Boucle pour ajouter des années de 1985 à 2050
                        for ($annee = 1985; $annee <= 2050; $annee++) {
                            echo "<option value='$annee'>$annee</option>";
                        }
                        ?>
                    </select>
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