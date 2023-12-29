<?php

class Utilisateur {

    function login($email){
        $result = get_result("SELECT * FROM utilisateur WHERE email_utilisateur = '".$email."'");
        return $result;
    }

    function getDataUtilisateur($idUser, $emailUser){
        $result = get_result("SELECT * FROM utilisateur WHERE id_utilisateur = '".$idUser."' AND email_utilisateur = '".$emailUser."'");
        return $result;
    }

    function updateDataUtilisateur($idUser, $dataUser){
        return set_update("utilisateur", $dataUser, "id_utilisateur = '".$idUser."'", true);
    }

    function getPasswordUtilisateur($idUser){
        $result = get_result("SELECT mdp_utilisateur FROM utilisateur WHERE id_utilisateur='".$idUser."'");
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
            return set_update("utilisateur", $values, "id_utilisateur='".$idUser."'", true);
        } else {
            return false;
        }
    }

    function addUtilisateur($email, $password){
        // Utilisez la fonction d'encryptPassword pour chiffrer le mot de passe
        $encryptedPassword = encryptPassword($password, 'public.pem');

        $values= array(
            "email_utilisateur" => $email,
            "mdp_utilisateur" => $encryptedPassword,
            // Ajoutez d'autres champs requis
        );

        return set_insert("utilisateur", $values, 1);
    }

    function log_account(){
        if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] == ""){
            $_SESSION['page_call'] = "https://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
            Header("Location: ".URLSITEWEB."se-connecter/");
            exit();
        }
    }

    function getUtilisateur($where){
        return get_result("SELECT * FROM utilisateur WHERE ".$where);
    }

    function getLstUtilisateur($where = null){
        $request = "SELECT * FROM utilisateur ";
        if($where) $request .= "WHERE ".$where;
        return get_results($request);
    }

    function setAddAdresse($values){
        return set_insert("utilisateur_adresse", $values, 1);
    }

    function setUpdateAdresse($id, $values){
        return set_update("utilisateur_adresse", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteAdresse($id){
        return set_delete("utilisateur_adresse", "id='".$id."'", 1);
    }

    function getAdresse($where){
        $request = "SELECT * FROM utilisateur_adresse WHERE ".$where;
        return get_result($request);
    }

    function getLstAdresse($where = null){
        $request = "SELECT * FROM utilisateur_adresse ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}
?>