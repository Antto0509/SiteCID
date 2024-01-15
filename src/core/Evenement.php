<?php

class Evenement {
    function getAllEvenements() {
        return get_result("SELECT * FROM Evenement");
    }

    function setAddEvenement($values): ?bool
    {
        return set_insert("Evenement", $values, 1);
    }

    function setUpdateEvenement($id, $values): ?bool
    {
        return set_update("Evenement", $values, 'id_evenement="'.$id.'"', 1);
    }

    function setDeleteEvenement($id): ?bool
    {
        return set_delete("Evenement", "id_evenement='".$id."'", 1);
    }

    function getEvenement($id){
        $request = "SELECT * FROM Evenement WHERE id_evenement='".$id."'";
        return get_result($request);
    }

    function getLstEvenements(): false|array
    {
        return get_results("SELECT * FROM Evenement ORDER BY id_evenement");
    }
}