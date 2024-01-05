<?php

class Pays
{
    function setAddPays($values): ?bool
    {
        // Mettez à jour la table à laquelle vous ajoutez l'adresse
        return set_insert("Pays", $values, 1);
    }

    function setUpdatePays($id, $values): ?bool
    {
        // Mettez à jour la table à laquelle vous mettez à jour l'adresse
        return set_update("Pays", $values, 'id_pays="'.$id.'"', 1);
    }

    function setDeletePays($id): ?bool
    {
        // Mettez à jour la table à laquelle vous supprimez l'adresse
        return set_delete("Pays", "id_pays='".$id."'", 1);
    }

    function getPays($where){
        // Mettez à jour la table à partir de laquelle vous obtenez l'adresse
        $request = "SELECT * FROM Pays WHERE ".$where;
        return get_result($request);
    }

    function getLstPays($where = null): false|array
    {
        // Mettez à jour la table à partir de laquelle vous obtenez la liste des adresses
        $request = "SELECT * FROM Pays ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}