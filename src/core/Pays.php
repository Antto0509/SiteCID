<?php

class Pays
{
    function setAddPays($values): ?bool
    {
        return set_insert("Pays", $values, 1);
    }

    function setUpdatePays($id, $values): ?bool
    {
        return set_update("Pays", $values, 'id_pays="'.$id.'"', 1);
    }

    function setDeletePays($id): ?bool
    {
        return set_delete("Pays", "id_pays='".$id."'", 1);
    }

    function getPays($id){
        $request = "SELECT * FROM Pays WHERE id_pays='".$id."'";
        return get_result($request);
    }

    function getLstPays(): false|array
    {
        return get_results("SELECT * FROM Evenement ORDER BY id_pays");
    }
}