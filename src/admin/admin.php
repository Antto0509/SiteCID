<?php
include('../parametres/configurations.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Espace administrateur <?php echo ' | '.NAME_SITE; ?></title>
</head>
<body>
    <?php include "../includes/header.php"; ?>

    <h1>Espace administrateur</h1>

    <main>
        <section id="compte">
            <a href="<?php echo PAGES_PATH. '/infoUser.php?id=' . $_SESSION['user_id'] ?>"><h2>Mon compte</h2></a>
        </section>

        <section id="gestion-etudiants">
            <a href="pages/users.php"><h2>Gestion des utilisateurs</h2></a>
        </section>

        <section id="gestion-photos">
            <a href="pages/pictures.php"><h2>Gestion des photos</h2></a>
        </section>

        <section id="gestion-evenements">
            <a href="pages/events.php"><h2>Gestion des événements</h2></a>
        </section>
    </main>

    <?php include "../includes/footer.php"; ?>
</body>
</html>
