<?php
include('../../parametres/configurations.php');

$evenement = new Evenement();
$listeEvenements = $evenement->getLstEvenements();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action'])){
        if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
            if (isset($_POST['id_evenement'])) {
                $id_evenement = $_POST['id_evenement'];
                $result = $evenement->setDeleteEvenement($id_evenement);
            }
        } else if (isset($_POST['action']) && $_POST['action'] === 'modifier' && isset($_POST['id_evenement'])) {
            $id_evenement = $_POST['id_evenement'];
            $evenement_to_update = $evenement->getEvenement($id_evenement);

            // Affichez le formulaire de modification avec les champs pré-remplis.
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/pages.css">
                <title>Modification d'événement | <?php echo NAME_SITE; ?></title>
            </head>
            <body>
            <?php include "../../includes/header.php"; ?>

            <h1>Modification d'événement</h1>
            <main>
                <form method="post" action="update_event.php"> <!-- Assurez-vous de créer une page de mise à jour appropriée -->
                    <!-- Ajoutez les champs du formulaire avec les valeurs pré-remplies -->
                    <input type="hidden" name="id_evenement" value="<?php echo $evenement_to_update['id_evenement']; ?>">
                    <label for="titre_evenement">Titre :</label>
                    <label>
                        <input type="text" name="titre_evenement" value="<?php echo $evenement_to_update['titre_evenement']; ?>" required>
                    </label>

                    <!-- Ajoutez d'autres champs ici -->

                    <button type="submit">Enregistrer les modifications</button>
                </form>
            </main>
            <a href="../admin.php" class="btn-retour">Retour</a>

            <?php include "../../includes/footer.php"; ?>
            </body>
            </html>
            <?php
            exit; // Arrêtez l'exécution du reste du code pour afficher uniquement le formulaire de modification.
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <title>Gestion des événements | <?php echo NAME_SITE; ?></title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <h1>Gestion des événements</h1>
    <h2>Liste des utilisateurs</h2>
    <main>
        <table class="table-gestion">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date</th>
                <th>Id de l'utilisateur</th>
                <th>Visibilité</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($listeEvenements) {
                foreach ($listeEvenements as $evenement) { ?>
                    <tr>
                        <td><?php echo $evenement['titre_evenement']; ?></td>
                        <td><?php echo $evenement['description_evenement']; ?></td>
                        <td><?php echo $evenement['date_evenement']; ?></td>
                        <td><?php echo $evenement['id_utilisateur']; ?></td>
                        <td><?php echo $evenement['id_visibilite'] == 1 ? 'Oui' : 'Non'; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="action" value="modifier">
                                <input type="hidden" name="id_evenement" value="<?php echo $evenement['id_evenement']; ?>">
                                <button type="submit" class="btn-modifier">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id_evenement" value="<?php echo $evenement['id_evenement']; ?>">
                                <button type="submit" class="btn-supprimer">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>
    </main>
    <a href="../admin.php" class="btn-retour">Retour</a>

    <?php include "../../includes/footer.php"; ?>
</body>
</html>