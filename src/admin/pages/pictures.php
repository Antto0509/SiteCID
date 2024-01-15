<?php
include('../../parametres/configurations.php');

$photo = new Photo();
$listePhotos = $photo->getLstPhotos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
        if (isset($_POST['id_photo'])) {
            $id_photo = $_POST['id_photo'];
            $result = $photo->setDeletePhoto($id_photo);

            // Ajoutez éventuellement ici un message de confirmation ou de traitement supplémentaire.
            // Vous pouvez rediriger l'utilisateur vers la page des événements après la suppression.
            // header("Location: event.php");
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
    <title>Gestion des photos | <?php echo NAME_SITE; ?></title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <h1>Gestion des photos</h1>
    <h2>Liste des événements</h2>
    <main>
        <table class="table-gestion">
            <thead>
            <tr>
                <th>Photo</th>
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
            if ($listePhotos) {
                foreach ($listePhotos as $photo) { ?>
                    <tr>
                        <td><?php echo $photo['url_photo']; ?></td>
                        <td><?php echo $photo['description_photo']; ?></td>
                        <td><?php echo $photo['date_photo']; ?></td>
                        <td><?php echo $photo['id_utilisateur']; ?></td>
                        <td><?php echo $photo['id_visibilite'] == 1 ? 'Oui' : 'Non'; ?></td>
                        <td><button class="btn-modifier">Modifier</button></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?');">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id_photo" value="<?php echo $photo['id_photo']; ?>">
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