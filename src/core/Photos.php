<?php

class Photo {
    // ...

    function getAllPhotos() {
        return get_result("SELECT * FROM Photo");
    }

    function setAddPhoto($values): ?bool
    {
        return set_insert("Photo", $values, 1);
    }

    function setUpdatePhoto($id, $values): ?bool
    {
        return set_update("Photo", $values, 'id_photo="'.$id.'"', 1);
    }

    function setDeletePhoto($id): ?bool
    {
        return set_delete("Photo", "id_photo='".$id."'", 1);
    }

    function getPhoto($id){
        $request = "SELECT * FROM Photo WHERE id_photo='".$id."'";
        return get_result($request);
    }

    function getLstPhotos(): false|array
    {
        return get_results("SELECT * FROM Photo ORDER BY id_photo");
    }
}
