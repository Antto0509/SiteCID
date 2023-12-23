<?php
session_start();

const URLSITEWEB = "http://176.223.137.210/SiteCID/src";
const ASSETS_PATH =  URLSITEWEB . '/assets';
const IMGS_PATH = ASSETS_PATH . '/imgs';
const PAGES_PATH = URLSITEWEB . '/pages';

date_default_timezone_set('Europe/Paris');

$base = 'cid';
$host = 'localhost';
$port = '3306';
$name = 'root';
$pass = 'basededonnee';

try {
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$base", $name, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    //die(); // Arrêter l'exécution du script en cas d'erreur
}
?>
