<?php

class Evenement {
// ...

function getAllEvenements() {
return get_result("SELECT * FROM Evenements");
}

// ...
}