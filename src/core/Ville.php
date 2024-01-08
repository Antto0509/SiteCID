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
        return set_insert("Ville", $values, 1);
    }

    public function setUpdateVille($id, $values): ?bool
    {
        return set_update("Ville", $values, 'id_ville="'.$id.'"', 1);
    }

    public function setDeleteVille($id): ?bool
    {
        return set_delete("Ville", "id_ville='".$id."'", 1);
    }

    public function getIdVille($nomVille){
        return get_result("SELECT id_ville FROM Ville WHERE nom_ville = '".$nomVille."'");
    }

    public function getVille($where)
    {
        return get_result("SELECT * FROM Ville WHERE ".$where);
    }

    public function getLstVille($where = null): false|array
    {
        $request = "SELECT * FROM Ville ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}