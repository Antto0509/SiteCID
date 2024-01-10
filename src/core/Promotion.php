<?php

class Promotion
{
    function setAddPromotion($values): ?bool
    {
        return set_insert("Promotion", $values, 1);
    }

    function setUpdatePromotion($id, $values): ?bool
    {
        return set_update("Promotion", $values, 'id_promotion="'.$id.'"', 1);
    }

    function setDeletePromotion($id): ?bool
    {
        return set_delete("Promotion", "id_promotion='".$id."'", 1);
    }

    function getPromotion($id){
        $request = "SELECT * FROM Promotion WHERE id_promotion='".$id."'";
        return get_result($request);
    }

    function getLstPromotion($where = null): false|array
    {
        $request = "SELECT * FROM Promotion ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}