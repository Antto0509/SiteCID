<?php
$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=CID',
    'root',
    'A3LQT'
    );

$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>