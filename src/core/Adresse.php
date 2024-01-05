<?php

class Adresse
{
    function setAddAdresse($values): ?bool
    {
        // Mettez à jour la table à laquelle vous ajoutez l'adresse
        return set_insert("Adresse", $values, 1);
    }

    function setUpdateAdresse($id, $values): ?bool
    {
        // Mettez à jour la table à laquelle vous mettez à jour l'adresse
        return set_update("Adresse", $values, 'id_adresse="'.$id.'"', 1);
    }

    function setDeleteAdresse($id): ?bool
    {
        // Mettez à jour la table à laquelle vous supprimez l'adresse
        return set_delete("Adresse", "id_adresse='".$id."'", 1);
    }

    function getMaxIdAdresse(){
        return get_result("SELECT MAX(id_adresse) FROM Adresse");
    }

    function getIdAdresse($where){
        return get_result("SELECT id_adresse FROM Adresse".$where);
    }

    function getAdresse($where){
        // Mettez à jour la table à partir de laquelle vous obtenez l'adresse
        $request = "SELECT * FROM Adresse WHERE ".$where;
        return get_result($request);
    }

    function getLstAdresse($where = null): false|array
    {
        // Mettez à jour la table à partir de laquelle vous obtenez la liste des adresses
        $request = "SELECT * FROM Adresse ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}