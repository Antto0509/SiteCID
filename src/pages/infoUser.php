<?php
include_once('../parametres/configurations.php');

// Vérifier si l'utilisateur est connecté en vérifiant la présence de variables de session
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion s'il n'est pas connecté
    header('Location: http://176.223.137.210/SiteCID/src/pages/login.php');
    exit();
}

// Récupérer le nom d'utilisateur à partir des paramètres de la requête
$id_utilisateur = $_GET['user_id'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/infoUser.css">
    </head>
    <body>

    <?php include "../includes/header.php"?>
    <header class="entete-banniere">
        <img src="../assets/imgs/iut-amiens.png" alt="Bannière" class="banniere">
        <!-- Ajout de la classe "photo-profil-trigger" pour faciliter la sélection en JavaScript -->
        <img src="../assets/imgs/photo-profil.png" alt="Photo de profil" class="photo-profil">
        <input type="file" id="input-photo-profil" style="display: none;">
    </header>


    <main class="conteneur-affichage-et-saisi">
        <!-- Boite affichant les informations personnelles de l'utilisateurs-->
        <section class="conteneur-infos-personnelles">
            <h2>Mes informations personnelles</h2>
            <form>
                <label for="sexe">Sexe:</label>
                <select id="sexe" name="sexe">
                    <option value="M">M.</option>
                    <option value="Mme">Mme.</option>
                </select>

                <label for="nom_utilisateur">Nom:</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" value=<?php //echo $utilisateurData['nom_utilisateur'] ?>>

                <label for="prenom_utilisateur">Prénom:</label>
                <input type="text" id="prenom_utilisateur" name="prenom_utilisateur">

                <label for="dateNaissance_utilisateur">Date de naissance:</label>
                <input type="date" id="dateNaissance_utilisateur" name="dateNaissance_utilisateur">

                <label for="email_utilisateur">Adresse mail:</label>
                <input type="email" id="email_utilisateur" name="email_utilisateur">

                <label for="anneePromotion_utilisateur">Année de promotion:</label>
                <input type="number" id="anneePromotion_utilisateur" name="anneePromotion_utilisateur">

                <label for="emploi_utilisateur">Emploi (facultatif):</label>
                <input type="text" id="emploi_utilisateur" name="emploi_utilisateur">

                <label for="ville_utilisateur">Ville de résidence (facultatif):</label>
                <input type="text" id="ville_utilisateur" name="ville_utilisateur">

                <button type="button">Modifier</button>
            </form>
        </section>

        <!-- Boite permettant à l'utilisateur de poster un évènement -->
        <section class="conteneur-poster-annonce">
            <h2>Créer et publier un événement</h2>
            <form>
                <label for="intitule_evenement">Intitulé de l'événement:</label>
                <input type="text" id="intitule_evenement" name="intitule_evenement">

                <label for="image_evenement">Importer une image:</label>
                <input type="file" id="image_evenement" name="image_evenement">

                <label for="description_evenement">Description de l'événement:</label>
                <textarea id="description_evenement" name="description_evenement"></textarea>

                <label for="date_evenement">Date de l'événement:</label>
                <input type="date" id="date_evenement" name="date_evenement">

                <label for="lieu_evenement">Lieu de l'événement:</label>
                <input type="text" id="lieu_evenement" name="lieu_evenement">

                <label for="nombrePlaces_evenement">Nombre de places:</label>
                <input type="number" id="nombrePlaces_evenement" name="nombrePlaces_evenement">

                <button type="button">Publier</button>
            </form>
        </section>
    </main>
    <?php include "../includes/footer.php"?>
    <script src="<?php echo SCRIPT_PATH; ?>/js/infoUser.js"></script>
    </body>
</html>