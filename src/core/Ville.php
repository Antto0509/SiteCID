<?php

class Ville
{
    public function isVilleExists($nomVille): bool
    {
        $result = get_result("SELECT COUNT(*) FROM Ville WHERE nom_ville = '".$nomVille."' LIMIT 1");
        return ($result['COUNT(*)'] > 0);
    }

    public function setAddVille($values): ?bool
    {
        // Mettez à jour la table à laquelle vous ajoutez la ville
        return set_insert("Ville", $values, 1);
    }

    public function setUpdateVille($id, $values): ?bool
    {
        // Mettez à jour la table à laquelle vous mettez à jour la ville
        return set_update("Ville", $values, 'id_ville="'.$id.'"', 1);
    }

    public function setDeleteVille($id): ?bool
    {
        // Mettez à jour la table à laquelle vous supprimez la ville
        return set_delete("Ville", "id_ville='".$id."'", 1);
    }

    function getIdVille($where){
        return get_result("SELECT id_ville FROM Ville".$where);
    }

    public function getVille($where)
    {
        // Mettez à jour la table à partir de laquelle vous obtenez la ville
        $request = "SELECT * FROM Ville WHERE ".$where;
        return get_result($request);
    }

    public function getLstVille($where = null): false|array
    {
        // Mettez à jour la table à partir de laquelle vous obtenez la liste des villes
        $request = "SELECT * FROM Ville ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}