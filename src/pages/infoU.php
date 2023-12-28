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
    <?php include "header.php"?>
    <main class="info-container">
    <header class="titre-info">
        <p></p>
    </header> 
    <section class="section-container">
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

        <div class="form-container descrition">
            <label for="description" class="label">description :</label>
            <span><?php echo $ligne['description']; ?></span>
        </div>
        
    </section>
    <?php include "footer.php"?>
</body>
</html>

