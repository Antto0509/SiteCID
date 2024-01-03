<?php

class Utilisateur {

    function login($email){
        $result = get_result("SELECT * FROM Utilisateur WHERE email_utilisateur = '".$email."'");
        return $result;
    }

    function getDataUtilisateur($idUser, $emailUser){
        $result = get_result("SELECT * FROM Utilisateur WHERE id_utilisateur = '".$idUser."' AND email_utilisateur = '".$emailUser."'");
        return $result;
    }

    function updateDataUtilisateur($idUser, $dataUser){
        return set_update("Utilisateur", $dataUser, "id_utilisateur = '".$idUser."'", true);
    }

    function getPasswordUtilisateur($idUser){
        $result = get_result("SELECT mdp_utilisateur FROM Utilisateur WHERE id_utilisateur='".$idUser."'");
        return $result;
    }

    function updatePasswordUtilisateur($idUser, $passwordUser, $newPassword){
        // Utilisez la fonction d'encryptPassword pour chiffrer les mots de passe
        $passwordUser = encryptPassword($passwordUser, 'public.pem');
        $newPassword = encryptPassword($newPassword, 'public.pem');

        // Comparez les mots de passe chiffrés
        $dataUser = $this->getPasswordUtilisateur($idUser);

        if ($passwordUser == $dataUser['mdp_utilisateur']) {
            $values = array(
                "mdp_utilisateur" => $newPassword,
            );

            // Mettez à jour le mot de passe chiffré
            return set_update("Utilisateur", $values, "id_utilisateur='".$idUser."'", true);
        } else {
            return false;
        }
    }

    function getNumberOfUsers() {
        $result = get_result("SELECT COUNT(*) as count FROM Utilisateur");
        return $result['count'];
    }

    function generateCustomUserId($nom, $prenom) {
        // Obtenez le nombre d'utilisateurs actuels
        $numero = $this->getNumberOfUsers() + 1;

        $nomAbrege = substr($nom, 0, 2);
        $prenomAbrege = substr($prenom, 0, 2);

        // Combinez le numéro, les deux premières lettres du nom et du prénom pour former l'ID personnalisé.
        $customUserId = $numero . $nomAbrege . $prenomAbrege;

        return $customUserId;
    }

    function addUtilisateur($nom, $prenom, $email, $password, $emploi, $genre, $promotion){
        // Utilisation de la fonction generateCustomId pour générer un Id à l'utilisateur
        $id_utilisateur = $this->generateCustomUserId($nom, $prenom);

        // Utilisation de la fonction d'encryptEmail pour chiffrer l'adresse mail
        /*$encryptedEmail = encryptEmail($email, 'public.pem');

        // Utilisation de la fonction d'encryptPassword pour chiffrer le mot de passe
        $encryptedPassword = encryptPassword($password, 'public.pem');*/

        // Détermine l'id_genre en fonction de la civilité
        $idGenre = ($genre === 'monsieur') ? 1 : 2; // 1 pour Homme, 2 pour Femme

        $idPromotion = ($promotion - 1985) + 1;

        $values = array(
            "id_utilisateur" => $id_utilisateur,
            "nom_utilisateur" => $nom,
            "prenom_utilisateur" => $prenom,
            "email_utilisateur" => $email /*$encryptedEmail*/,
            "mdp_utilisateur" => $password /*$encryptedPassword*/,
            "num_tel_utilisateur" => null,
            "date_naissance_utilisateur" => null,
            "emploi_utilisateur" => $emploi,
            "url_photo_utilisateur" => null,
            "id_adresse" => null,
            "id_genre" => $idGenre,
            "id_promotion" => $idPromotion,
            "id_role" => 2, // 1 pour Administrateur, 2 pour Utilisateur
            "id_visibilite" => 2 // 1 pour Visible, 2 pour Non visible
        );

        return set_insert("Utilisateur", $values, 1);
    }

    function log_account(){
        if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] == ""){
            $_SESSION['page_call'] = "https://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
            header("Location: ".PAGES_PATH."/login.php");
            exit();
        }
    }

    function getIdUtilisateur($where){
        return get_result("SELECT id_utilisateur FROM Utilisateur".where);
    }

    function getUtilisateur($where){
        return get_result("SELECT * FROM Utilisateur WHERE ".$where);
    }

    function getLstUtilisateur($where = null){
        $request = "SELECT * FROM Utilisateur ";
        if($where) $request .= "WHERE ".$where;
        return get_results($request);
    }

    function setAddAdresse($values){
        // Mettez à jour la table à laquelle vous ajoutez l'adresse
        return set_insert("Adresse", $values, 1);
    }

    function setUpdateAdresse($id, $values){
        // Mettez à jour la table à laquelle vous mettez à jour l'adresse
        return set_update("Adresse", $values, 'id_adresse="'.$id.'"', 1);
    }

    function setDeleteAdresse($id){
        // Mettez à jour la table à laquelle vous supprimez l'adresse
        return set_delete("Adresse", "id_adresse='".$id."'", 1);
    }

    function getAdresse($where){
        // Mettez à jour la table à partir de laquelle vous obtenez l'adresse
        $request = "SELECT * FROM Adresse WHERE ".$where;
        return get_result($request);
    }

    function getLstAdresse($where = null){
        // Mettez à jour la table à partir de laquelle vous obtenez la liste des adresses
        $request = "SELECT * FROM Adresse ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}
?>