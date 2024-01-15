<?php
include('parametres/configurations.php');

$redirectUrl = PAGES_PATH . '/login.php';

if ($_SESSION['user_id'] !== null) {
    $redirectUrl = PAGES_PATH . '/infoUser.php?id=' . $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil | <?php echo NAME_SITE ?></title>
</head>
<body class="body-index">
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

    <h1>Annonces des étudiants</h1>
    <div class="event-card">
        <h2>Aucun événement pour le moment</h2>
        <p>Vous pouvez ajouter un événement en cliquant sur le bouton ci-dessous :</p>
        <a href="<?php echo $redirectUrl ?>"><button>Ajouter un événement</button></a>
    </div>

    <?php include "includes/footer.php";?>
</body>
</html>

