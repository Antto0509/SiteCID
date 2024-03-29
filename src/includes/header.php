<?php
global $bdd;

$resultUtilisateur = "";
$resultEvenement = "";
$resultPhoto = "";

// Vérifie si le formulaire a été soumis et s'il y a un terme de recherche
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_term'])) {
    // Récupérer le terme de recherche depuis le formulaire
    $term = $_GET['search_term'];

    // Vérifier si le terme n'est pas vide
    if (!empty($term)) {
        // Échapper le terme de recherche pour éviter les injections SQL
        $escapedTerm = str_replace(["'"], '', $bdd->quote($term));

        // Requête pour rechercher des utilisateurs en fonction du terme
        $queryUtilisateur = "SELECT * FROM Utilisateur WHERE nom_utilisateur LIKE '%$escapedTerm%' OR prenom_utilisateur LIKE '%$escapedTerm%' OR email_utilisateur LIKE '%$escapedTerm%'";

        // Requête pour rechercher des événements en fonction du terme
        $queryEvenement = "SELECT * FROM Evenement WHERE titre_evenement LIKE '%$escapedTerm%' OR description_evenement LIKE '%$escapedTerm%'";

        // Requête pour rechercher des photos en fonction du terme
        $queryPhoto = "SELECT * FROM Photo WHERE description_photo LIKE '%$escapedTerm%'";

        // Exécuter les requêtes
        $resultUtilisateur = get_results($queryUtilisateur);
        $resultEvenement = get_results($queryEvenement);
        $resultPhoto = get_results($queryPhoto);
    }
}

$infoUser = PAGES_PATH . '/infoUser.php?id=';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo URLSITEWEB; ?>/css/header.css">

<header class="entete">
    <a href="<?php echo URLSITEWEB; ?>/index.php"><img class="logo" src="<?php echo IMGS_PATH; ?>/logo.png" alt=""></a>

    <?php
    $menuVisible = isset($_GET['menu']) && $_GET['menu'] == 'open';
    ?>

    <div class="sidenav <?php echo $menuVisible ? 'active' : ''; ?>">
        <a id="closeBtn" href="?menu=close" class="close">×</a>
        <ul>
            <li><a href="#">A propos</a></li>
            <li><a href="#">Nos services</a></li>
            <li><a href="#">Témoignages</a></li>
            <li><a href="#">Contact</a></li>
            <?php if (empty($_SESSION['user_id'])) { ?>
                <li><a href="<?php echo PAGES_PATH . '/login.php'; ?>">Mon compte</a></li>
            <?php } else { ?>
                <li><a href="<?php echo $infoUser . $_SESSION['user_id']; ?>">Mon compte</a></li>
            <?php } ?>
        </ul>
    </div>

    <a href="?menu=open" class="openBtn">
        <span class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <form class="search__container" method="GET" action="">
        <input class="search__input" type="text" placeholder="Rechercher un évènement, une personne..." name="search_term" value="<?php echo isset($term) ? $term : ''; ?>">
    </form>
    <?php if (!empty($term)) { ?>
        <div class="result-container">
            <?php
            if (count($resultUtilisateur) > 0 || count($resultEvenement) > 0 || count($resultPhoto) > 0) {
                if (count($resultUtilisateur) > 0) {
                    echo '<p>Utilisateurs :</p>';
                    for ($i = 0; $i < count($resultUtilisateur); $i++) {
                        $userUrl = $infoUser . $resultUtilisateur[$i]['id_utilisateur'];
                        ?> <a href="<?php echo $userUrl ?>"> <?php echo $resultUtilisateur[$i]['nom_utilisateur'].' '.$resultUtilisateur[$i]['prenom_utilisateur'].'</a>';
                    }
                }

                if (count($resultEvenement) > 0) {
                    echo '<p>Événements :</p>';
                    for ($i = 0; $i < count($resultUtilisateur); $i++) {
                        $eventUrl = PAGES_PATH . '/event.php?id=' . $resultEvenement[$i]['id_evenement'];
                        ?> <a href="<?php echo $eventUrl ?>"> <?php echo $resultEvenement[$i]['titre_evenement'].'</a>';
                    }
                }

                if (count($resultPhoto) > 0) {
                    echo '<p>Photos :</p>';
                    for ($i = 0; $i < count($resultUtilisateur); $i++) {
                        $pictureUrl = PAGES_PATH . '/picture.php?id=' . $resultPhoto[$i]['id_photo'];
                        ?> <a href="<?php echo $pictureUrl ?>"> <?php echo $resultPhoto[$i]['titre_evenement'].'</a>';
                    }
                }
            } else {
                echo '<p>Aucun résultat trouvé.</p>';
            }
            ?>
        </div>
    <?php } ?>

    <div class="header-right">
        <a href="" class="btn-mail"><img class="mail" src="<?php echo IMGS_PATH; ?>/mail.png" alt=""></a>
        <?php if (empty($_SESSION['user_id'])) { ?>
            <a href="<?php echo PAGES_PATH . '/login.php'; ?>" class="btn-compte"><img class="compte" src="<?php echo IMGS_PATH; ?>/compte.png" alt=""></a>
        <?php } else { ?>
            <a href="<?php echo $infoUser . $_SESSION['user_id']; ?>" class="btn-compte"><img class="compte" src="<?php echo IMGS_PATH; ?>/compte.png" alt=""></a>
        <?php } ?>
    </div>
</header>