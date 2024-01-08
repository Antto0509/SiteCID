<?php

use Random\RandomException;

class Utilisateur {

    function login($email){
        return get_result("SELECT * FROM Utilisateur WHERE email_utilisateur = '".$email."'");
    }

    public function isUserExists($email): bool
    {
        $result = get_result("SELECT COUNT(*) FROM Utilisateur WHERE email_utilisateur = '".$email."' LIMIT 1");
        return ($result['COUNT(*)'] > 0);
    }

    function getDataUtilisateur($idUser, $emailUser){
        return get_result("SELECT * FROM Utilisateur WHERE id_utilisateur = '".$idUser."' AND email_utilisateur = '".$emailUser."'");
    }

    function updateDataUtilisateur($idUser, $dataUser): ?bool
    {
        return set_update("Utilisateur", $dataUser, "id_utilisateur = '".$idUser."'", true);
    }

    function getPasswordUtilisateur($idUser){
        return get_result("SELECT mdp_utilisateur FROM Utilisateur WHERE id_utilisateur='".$idUser."'");
    }

    function updatePasswordUtilisateur($idUser, $passwordUser, $newPassword): ?bool
    {
        $publicKey = openssl_pkey_get_public($_SESSION['public_key']);

        // Utilise la fonction d'encryptPassword pour chiffrer les mots de passe
        $passwordUser = encrypt($passwordUser, $publicKey);
        $newPassword = encrypt($newPassword, $publicKey);

        // Compare les mots de passe chiffrés
        $dataUser = $this->getPasswordUtilisateur($idUser);

        if ($passwordUser == $dataUser['mdp_utilisateur']) {
            $values = array(
                "mdp_utilisateur" => $newPassword,
            );

            // Met à jour le mot de passe chiffré
            return set_update("Utilisateur", $values, "id_utilisateur='".$idUser."'", true);
        } else {
            return false;
        }
    }

    function getNumberOfUsers() {
        $result = get_result("SELECT COUNT(*) as count FROM Utilisateur");
        return $result['count'];
    }

    /**
     * @throws RandomException
     */
    function generateCustomUserId($nom, $prenom): string
    {
        $nomAbrege = substr($nom, 0, 2);
        $prenomAbrege = substr($prenom, 0, 2);

        // Génére une partie aléatoire
        $partieAleatoire = bin2hex(random_bytes(4));

        return $nomAbrege . $prenomAbrege . $partieAleatoire;
    }


    function addUtilisateur($customUserId, $nom, $prenom, $email, $password, $emploi, $genre, $promotion, $adresse): ?bool
    {
        $publicKey = openssl_pkey_get_public($_SESSION['public_key']);

        // Utilisation de la fonction d'encryptEmail pour chiffrer l'adresse mail
        $encryptedEmail = encrypt($email, $publicKey);

        // Utilisation de la fonction d'encryptPassword pour chiffrer le mot de passe
        $encryptedPassword = encrypt($password, $publicKey);

        // Détermine l'id_genre en fonction de la civilité
        $idGenre = ($genre === 'monsieur') ? 1 : 2; // 1 pour Homme, 2 pour Femme

        $idPromotion = ($promotion - 1985) + 1;

        $values = array(
            "id_utilisateur" => $customUserId,
            "nom_utilisateur" => $nom,
            "prenom_utilisateur" => $prenom,
            "email_utilisateur" => $encryptedEmail,
            "mdp_utilisateur" => $encryptedPassword,
            "num_tel_utilisateur" => null,
            "date_naissance_utilisateur" => null,
            "emploi_utilisateur" => $emploi,
            "url_photo_utilisateur" => null,
            "id_adresse" => $adresse,
            "id_genre" => $idGenre,
            "id_promotion" => $idPromotion,
            "id_role" => 2, // 1 pour Administrateur, 2 pour Utilisateur
            "id_visibilite" => 2 // 1 pour Visible, 2 pour Non visible
        );

        return set_insert("Utilisateur", $values, 1);
    }

    function log_account(): void
    {
        if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] == ""){
            $_SESSION['page_call'] = "https://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
            header("Location: ".PAGES_PATH."/login.php");
            exit();
        }
    }

    function getIdUtilisateur($where){
        return get_result("SELECT id_utilisateur FROM Utilisateur".$where);
    }

    function getUtilisateur($where){
        return get_result("SELECT * FROM Utilisateur WHERE ".$where);
    }

    function getLstUtilisateur($where = null): false|array
    {
        $request = "SELECT * FROM Utilisateur ";
        if($where) $request .= "WHERE ".$where;
        return get_results($request);
    }
}
?>