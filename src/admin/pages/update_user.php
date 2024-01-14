<?php
include('../../parametres/configurations.php');

$utilisateur = new Utilisateur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que tous les champs nécessaires sont présents dans le formulaire
    if (isset($_POST['id_utilisateur'], $_POST['titre_utilisateur'])) {
        $id_utilisateur = $_POST['id_utilisateur'];
        // Ajoutez les autres champs ici

        // Construisez un tableau associatif des valeurs à mettre à jour
        $update_values = array(
            // Ajoutez les champs ici
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
    <main>
        <!-- Ajoutez ici le contenu de la page de mise à jour si nécessaire -->
    </main>
    <a href="../admin.php" class="btn-retour">Retour</a>

    <?php include "../../includes/footer.php"; ?>
</body>
</html>
