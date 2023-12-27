<?php
include_once('parametres/configurations.php');

// Requête SQL pour récupérer les événements triés par date décroissante
$sql = "SELECT * FROM Evenement ORDER BY date_evenement DESC";
$evenements = get_results($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil - Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <?php include "includes/header.php";?>

    <h1>Présentation</h1>
    <div class="box-prez">
        <div class="col1-prez">
            <h2>Mot du président :</h2>
            <p class="texte">Bonjour à tous,</p>
            <p class="texte">Je suis Nathalie Demazeux, la Présidente de l'association du Cercle des Informaticiens Dispersés (CID). Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit. Sed sed arcu neque. Vestibulum id luctus dui, ut pharetra mi. Fusce tincidunt dolor nec pulvinar 
                condimentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam mollis, turpis eget 
                pharetra eleifend, libero ipsum commodo leo, in placerat leo enim.</p>
            <p class="texte">À bientôt,</p>
            <p class="texte">Nathalie Demazeux</p>
        </div>
        <div class="col2-prez">
            <img src="https://placehold.co/50x50" alt="">
            <p class="texte">Présidente</p>
            <p class="texte">Secrétaire</p>
            <img src="https://placehold.co/50x50" alt="">
        </div>
    </div>

    <h1>Annonces des événements</h1>
    <div class="event-card">
        <?php
        // Vérifier s'il y a des événements
        if (count($evenements) > 0) {
            foreach ($evenements as $evenement) {
                // Afficher les détails de chaque événement
                echo "<h2>" . htmlspecialchars($evenement['description_evenement']) . "</h2>";
                echo "<p>Date : " . htmlspecialchars($evenement['date_evenement']) . "</p>";
                echo "<p>Adresse : " . htmlspecialchars($evenement['adresse_evenement']) . "</p>";
                // ... Ajoutez d'autres détails d'événement selon vos besoins
            }
        } else {
            // Aucun événement trouvé
            echo "<h2>Aucun événement pour le moment</h2>";
            echo "<p>Vous pouvez ajouter un événement en cliquant sur le bouton ci-dessous :</p>";
            echo "<a href='" . PAGES_PATH . "/event.php'><button>Ajouter un événement</button></a>";
        }
        ?>
    </div>

    <?php include "includes/footer.php";?>
</body>
</html>

