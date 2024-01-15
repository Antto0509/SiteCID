<?php
include('../../parametres/configurations.php');

$utilisateur = new Utilisateur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que tous les champs nécessaires sont présents dans le formulaire
    if (isset($_POST['id_utilisateur'])) {
        $id_utilisateur = $_POST['id_utilisateur'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $num_tel = $_POST['phone'];
        $date_naissance = $_POST['date_naissance'];
        $emploi = $_POST['emploi'];
        $photo = $_POST['photo'];
        $idGenre = (isset($_POST['monsieur']) ? 'monsieur' : (isset($_POST['madame']) ? 'madame' : '') === 'monsieur') ? 1 : 2;
        $idPromotion = ($_POST['annee_promotion'] - 1985) + 1;
        $idRole = (isset($_POST['administrateur']) ? 'administrateur' : (isset($_POST['utilisateur']) ? 'utilisateur' : '') === 'administrateur') ? 1 : 2;
        $idVisibilite = (isset($_POST['visible']) ? 'visible' : (isset($_POST['non-visible']) ? 'non-visible' : '') === 'visible') ? 1 : 2;
        // Ajoutez les autres champs ici

        // Construisez un tableau associatif des valeurs à mettre à jour
        $update_values = array(
            "id_utilisateur" => $id_utilisateur,
            "nom_utilisateur" => $nom,
            "prenom_utilisateur" => $prenom,
            "num_tel_utilisateur" => $num_tel,
            "date_naissance_utilisateur" => $date_naissance,
            "emploi_utilisateur" => $emploi,
            "url_photo_utilisateur" => $photo,
            "id_genre" => $idGenre,
            "id_promotion" => $idPromotion,
            "id_role" => $idRole,
            "id_visibilite" => $idVisibilite
        );

        // Appelez la fonction de mise à jour de la classe Utilisateur
        $result = $utilisateur->setUpdateUtilisateur($id_utilisateur, $update_values);

        // Ajoutez des vérifications supplémentaires et des messages de confirmation si nécessaire
        if ($result) {
            echo "Utilisateur mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour de l'utilisateur.";
        }
    } else {
        echo "Tous les champs nécessaires ne sont pas présents dans le formulaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <title>Mise à jour d'utilisateur | <?php echo NAME_SITE; ?></title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <h1>Mise à jour d'utilisateur</h1>
    <main class="conteneur-modification">
        <section class="saisie-modification">
            <form action="" method="post">
                <div>
                    <label for="photo">Importer une photo</label>
                    <input type="file" id="photo" name="photo">
                </div>

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

                <div>
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance">
                </div>

                <div class="groupe-input">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" required />
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
                    <label for="emploi">Emploi</label>
                    <input type="text" id="emploi" name="emploi">
                </div>

                <div class="groupe-input">
                    <label for="rue">Rue de résidence</label>
                    <input type="text" id="rue" name="rue">
                </div>

                <div class="groupe-input">
                    <label for="ville">Ville de résidence</label>
                    <input type="text" id="ville" name="ville">
                </div>

                <div class="groupe-input">
                    <label for="pays">Pays de résidence</label>
                    <input type="text" id="pays" name="pays">
                </div>
            </form>

            <div class="groupe-role">
                <div class="groupe-input">
                    <label for="administrateur">Administrateur</label>
                    <input type="checkbox" id="administrateur" name="administrateur">
                </div>

                <div class="groupe-input">
                    <label for="utilisateur">Utilisateur</label>
                    <input type="checkbox" id="utilisateur" name="utilisateur">
                </div>
            </div>

            <div class="groupe-visibilite">
                <div class="groupe-input">
                    <label for="visible">Visible</label>
                    <input type="checkbox" id="visible" name="visible">
                </div>

                <div class="groupe-input">
                    <label for="non-visible">Non-visible</label>
                    <input type="checkbox" id="non-visible" name="non-visible">
                </div>
            </div>

            <?php if (isset($errorMessage)) : ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </section>
    </main>
    <a href="../admin.php" class="btn-retour">Retour</a>

    <?php include "../../includes/footer.php"; ?>
</body>
</html>
