<?php
include('../../parametres/configurations.php');

$promotion = new Promotion();
$adresse = new Adresse();
$ville = new Ville();
$pays = new Pays();
$utilisateur = new Utilisateur();

$listeUtilisateurs = $utilisateur->getListeUtilisateurs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action'])){
        if ($_POST['action'] === 'supprimer') {
            if (isset($_POST['id_utilisateur'])) {
                $id_utilisateur = $_POST['id_utilisateur'];
                $result = $utilisateur->setDeleteUtilisateur($id_utilisateur);
            }
        } else if ($_POST['action'] === 'modifier' && isset($_POST['id_utilisateur'])) {
            $id_utilisateur = $_POST['id_utilisateur'];

            $utilisateur_to_update = $utilisateur->getDataUtilisateur($id_utilisateur);
            $promotion_to_update = $promotion->getPromotion($utilisateur_to_update['id_promotion']);
            $adresse_to_update = $adresse->getAdresse($utilisateur_to_update['id_adresse']);
            $ville_to_update = $ville->getVille($adresse_to_update['id_ville']);
            $pays_to_update = $pays->getPays($adresse_to_update['id_pays']);

            // Affichez le formulaire de modification avec les champs pré-remplis.
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/pages.css">
                <title>Modification d'utilisateur | <?php echo NAME_SITE; ?></title>
            </head>
            <body>
            <?php include "../../includes/header.php"; ?>

            <h1 id="titre-modification-utilisateur">Modification d'utilisateur</h1>
            <main>
                <form id="formulaire-modification-utilisateur" method="post" action="update_user.php"> <!-- Assurez-vous de créer une page de mise à jour appropriée -->
                    <!-- Ajoutez les champs du formulaire avec les valeurs pré-remplies -->
                    <label for="id_utilisateur">Id de l'utilisateur :</label>
                    <input type="text" id="id_utilisateur" name="id_utilisateur" value=<?php echo $utilisateur_to_update['id_utilisateur']; ?>><br>

                    <label for="sexe">Sexe :</label>
                    <select id="sexe" name="sexe">
                        <option value="M">M.</option>
                        <option value="Mme">Mme.</option>
                    </select><br>

                    <label for="nom_utilisateur">Nom :</label>
                    <input type="text" id="nom_utilisateur" name="nom_utilisateur" value=<?php echo $utilisateur_to_update['nom_utilisateur'] ?>><br>

                    <label for="prenom_utilisateur">Prénom :</label>
                    <input type="text" id="prenom_utilisateur" name="prenom_utilisateur" value=<?php echo $utilisateur_to_update['prenom_utilisateur'] ?>><br>

                    <label for="dateNaissance_utilisateur">Date de naissance:</label>
                    <input type="date" id="dateNaissance_utilisateur" name="dateNaissance_utilisateur" value=<?php echo $utilisateur_to_update['date_naissance_utilisateur'] ? $utilisateur_to_update['date_naissance_utilisateur'] : "" ?>><br>

                    <label for="email_utilisateur">Adresse mail:</label>
                    <input type="email" id="email_utilisateur" name="email_utilisateur" value=<?php echo $utilisateur_to_update['email_utilisateur']; ?>><br>

                    <label for="anneePromotion_utilisateur">Année de promotion:</label>
                    <input type="number" id="anneePromotion_utilisateur" name="anneePromotion_utilisateur" value=<?php echo $promotion_to_update['annee_promotion']; ?>><br>

                    <label for="emploi_utilisateur">Emploi :</label>
                    <input type="text" id="emploi_utilisateur" name="emploi_utilisateur" value=<?php echo $utilisateur_to_update['emploi_utilisateur'] ? $utilisateur_to_update['emploi_utilisateur'] : "" ?>><br>

                    <label for="rue_utilisateur">Rue de résidence :</label>
                    <input type="text" id="rue_utilisateur" name="rue_utilisateur" value=<?php echo $adresse_to_update['rue'] ? $adresse_to_update['rue'] : "" ?>><br>

                    <label for="ville_utilisateur">Ville de résidence :</label>
                    <input type="text" id="ville_utilisateur" name="ville_utilisateur" value=<?php echo $ville_to_update['nom_ville'] ?? "" ?>><br>

                    <label for="pays_utilisateur">Pays de résidence :</label>
                    <input type="text" id="pays_utilisateur" name="pays_utilisateur" value=<?php echo $pays_to_update['nom_pays'] ?? "" ?>><br>

                    <button id="bouton-modifier" type="submit">Enregistrer les modifications</button>
                </form>
            </main>
            <a href="../admin.php" class="btn-retour">Retour</a>

            <?php include "../../includes/footer.php"; ?>
            </body>
            </html>
            <?php
            exit; // Arrêtez l'exécution du reste du code pour afficher uniquement le formulaire de modification.
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
    <title>Gestion des utilisateurs | <?php echo NAME_SITE ?></title>
</head>
<body>
    <?php include "../../includes/header.php"; ?>

    <h1>Gestion des utilisateurs</h1>
    <h2>Liste des utilisateurs</h2>
    <main>
        <table class="table-gestion">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Promotion</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($listeUtilisateurs) {
                foreach ($listeUtilisateurs as $utilisateur) {
                    $promotionData = $promotion->getPromotion($utilisateur['id_promotion']); ?>
                    <tr>
                        <td><?php echo $utilisateur['id_utilisateur']; ?></td>
                        <td><?php echo $utilisateur['nom_utilisateur']; ?></td>
                        <td><?php echo $utilisateur['prenom_utilisateur']; ?></td>
                        <td><a href="mailto:<?php echo $utilisateur['email_utilisateur']; ?>?subject=Sujet du message"><?php echo $utilisateur['email_utilisateur']; ?></a></td>
                        <td><?php echo $promotionData['annee_promotion']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="action" value="modifier">
                                <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur']; ?>">
                                <button type="submit" class="btn-modifier">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur']; ?>">
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