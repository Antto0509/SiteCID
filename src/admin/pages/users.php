<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../../parametres/configurations.php');

$utilisateur = new Utilisateur();
$listeUtilisateurs = $utilisateur->getListeUtilisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <title>Gestion des Étudiants</title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <main>
        <h1>Gestion des Étudiants</h1>
        <h2>Liste des Étudiants</h2>
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <!-- Ajoutez d'autres en-têtes de colonne au besoin -->
            </tr>
            </thead>
            <tbody>
            <?php
            if ($listeUtilisateurs) {
                foreach ($listeUtilisateurs as $utilisateur) { ?>
                <tr>
                    <td><?php echo $utilisateur['nom_utilisateur']; ?></td>
                    <td><?php echo $utilisateur['prenom_utilisateur']; ?></td>
                    <td><?php echo $utilisateur['email_utilisateur']; ?></td>
                    <!-- Ajoutez d'autres colonnes au besoin -->
                </tr>
                <?php
                }
            } ?>
            </tbody>
        </table>
    </main>

    <?php include "../../includes/footer.php"; ?>
</body>
</html>