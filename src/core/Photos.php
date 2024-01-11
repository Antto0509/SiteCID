<?php

class Photo {
    // ...

    function getAllPhotos() {
        return get_result("SELECT * FROM Photo");
    }

    // ...
}