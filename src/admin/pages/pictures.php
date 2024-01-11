<?php
include('../../parametres/configurations.php');

$photo = new Photo();
$liste_photos = $photo->getAllPhotos(); // Assurez-vous que la méthode 'getAllPhotos' existe dans la classe Photo

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Votre en-tête ici -->
</head>
<body>
<main>
    <h1>Galerie de Photos</h1>
    <div>
        <?php foreach ($liste_photos as $photo): ?>
            <div>
                <img src="<?php echo $photo['url_photo']; ?>" alt="<?php echo $photo['description_photo']; ?>">
                <p><?php echo $photo['date_photo']; ?></p>
                <!-- Ajoutez d'autres informations au besoin -->
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>