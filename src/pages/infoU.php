<?php
include_once('../parametres/configurations.php');
include_once ('../core/Utilisateur.php');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/infoPersonnel.css">
    <title>information personnel - Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <!-- Page de connexion (identifiants ou e-mail + mdp) -->
    <?php include "../includes/header.php"?>
    <main class="info-container">
    <header class="titre-info">
        <p>Information personnel</p>
    </header> 
    <section class="section-infos-perso">
        <div class="form-container">
            <label for="nom" class="label">Nom :</label>
            <span><?php echo $ligne['nom']; ?></span>
        </div>

        <div class="form-container">
            <label for="prenom" class="label">Prénom :</label>
            <span><?php echo $ligne['prenom']; ?></span>
        </div>

        <div class="form-container">
            <label for="email" class="label">Email :</label>
            <span><?php echo $ligne['adresse_email']; ?></span>
        </div>

        <?php
        // Initialisez une session PHP pour stocker la description
        session_start();

        // Vérifiez si la variable de session pour la description existe
        if (!isset($_SESSION['description'])) {
            $_SESSION['description'] = '';
        }

        // Vérifiez quel bouton a été cliqué
        if (isset($_POST['ajouter'])) {
            // Ajoutez la nouvelle description à la variable de session
            $_SESSION['description'] .= $_POST['description'] . "\n";
        } elseif (isset($_POST['enregistrer'])) {
            // Vous pouvez implémenter ici la logique pour enregistrer la description, par exemple via une base de données
            echo 'Description enregistrée : ' . $_SESSION['description'];
        } elseif (isset($_POST['supprimer'])) {
            // Réinitialisez la variable de session pour la description
            $_SESSION['description'] = '';
        }

        // Redirigez l'utilisateur vers la page d'origine
        //header('Location: infoU.php');
        ?>

        <form action="" method="post">
            <div>
                <label for="description">Description :</label>
                <a>
                    <textarea name="description" id="description" rows="4" cols="50"></textarea>
                </a>
            </div>
    
            <button type="submit" name="ajouter">Ajouter</button>
            <button type="submit" name="enregistrer">Enregistrer</button>
            <button type="submit" name="supprimer">Supprimer</button>

        </form>
        
    </section>
    </main>
    <?php include "../includes/footer.php"?>
</body>
</html>

