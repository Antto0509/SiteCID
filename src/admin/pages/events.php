<?php
include('../../parametres/configurations.php');

$evenement = new Evenement();
$liste_evenements = $evenement->getAllEvenements(); // Assurez-vous que la méthode 'getAllEvenements' existe dans la classe Evenement
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gestion des Événements</title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <main>
        <h1>Gestion des Événements</h1>
        <h2>Liste des Événements</h2>
        <table>
            <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Description</th>
                <!-- Ajoutez d'autres en-têtes de colonne au besoin -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($liste_evenements as $event): ?>
                <tr>
                    <td><?php echo $event['titre_evenement']; ?></td>
                    <td><?php echo $event['date_evenement']; ?></td>
                    <td><?php echo $event['description_evenement']; ?></td>
                    <!-- Ajoutez d'autres colonnes au besoin -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include "../../includes/footer.php"; ?>
</body>
</html>