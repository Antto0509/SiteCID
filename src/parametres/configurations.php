<?php
session_start();

const URLSITEWEB = "http://176.223.137.210/SiteCID/src";
const ASSETS_PATH =  URLSITEWEB . '/assets';
const IMGS_PATH = ASSETS_PATH . '/imgs';
const PAGES_PATH = URLSITEWEB . '/pages';

date_default_timezone_set('Europe/Paris');

$DEBUG_SELECT = false;
$DEBUG_SELECT_MULTIPLE = false;
$DEBUG_INSERT = false;
$DEBUG_UPDATE = false;
$DEBUG_DELETE = false;

// Base de donnée
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
    die(); // Arrêter l'exécution du script en cas d'erreur
}

function get_results($requete){
    global $bdd, $DEBUG_SELECT_MULTIPLE;

    try {
        // Vérifier si la connexion à la base de données est établie
        if ($bdd) {
            if($DEBUG_SELECT_MULTIPLE) var_dump($requete);
            $resultats = $bdd->query($requete);
            if($DEBUG_SELECT_MULTIPLE) var_dump($resultats);
            return $resultats->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Gérer l'erreur de connexion
            echo 'Erreur de connexion à la base de données.';
            return array();
        }
    } catch (PDOException $e) {
        // Gérer l'erreur de requête SQL
        echo 'Erreur de requête SQL : ' . $e->getMessage();
        return array();
    }
}

function get_result($requete){
    global $bdd, $DEBUG_SELECT;
    if($DEBUG_SELECT) var_dump($requete);
    $requete = $bdd->query($requete);
    if($DEBUG_SELECT) var_dump($requete);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function set_insert($table, $values, $return = null, $returnId = null){
    global $bdd, $DEBUG_INSERT;

    $requete = "INSERT INTO ".$table."(";
    $i=0;
    foreach(array_keys($values) as $array){
        if($i>0) $requete .= ", ";
        $requete .= $array;
        $i++;
    }
    $requete .= ") VALUES(";
    $i=0;
    foreach(array_keys($values) as $array){
        if($i>0) $requete .= ", ";
        $requete .= ":".$array;
        $i++;
    }
    $requete .= ")";
    $q = $bdd->prepare($requete);

    foreach($values as $key=>$array)
    {
        $q->bindValue(':'.$key, $array, PDO::PARAM_STR);
    }

    if($DEBUG_INSERT) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_INSERT) var_dump($q->errorInfo());
            if($returnId) $_SESSION['lastInsertId'] = $bdd->lastInsertId();
            return true;
        }else{
            if($DEBUG_INSERT) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        $q->execute();
        if($returnId) $_SESSION['lastInsertId'] = $bdd->lastInsertId();
        if($DEBUG_INSERT) var_dump($q->errorInfo());
    }
}

function set_update($table, $values, $id, $return = null){
    global $bdd, $DEBUG_UPDATE;

    $requete = "UPDATE ".$table." SET ";
    $i=0;
    foreach($values as $key=>$array){
        if((isset($key) && isset($array)) || (isset($key) && $array == NULL)){
            if($i>0) $requete .= ", ";
            $requete .= $key.'=:'.$key;
            $i++;
        }
    }
    $requete .= " WHERE ".$id;

    $q = $bdd->prepare($requete);
    foreach($values as $key=>$array)
    {
        if((isset($key) && isset($array)) || (isset($key) && $array == NULL)) $q->bindValue(':'.$key, $array, PDO::PARAM_STR);
    }

    if($DEBUG_UPDATE) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_UPDATE) var_dump($q->errorInfo());
            return true;
        }else{
            if($DEBUG_UPDATE) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        $q->execute();
        if($DEBUG_UPDATE) var_dump($q->errorInfo());
    }
}

function set_delete($table, $values, $return){
    global $bdd, $DEBUG_DELETE;
    $requete = "DELETE FROM ".$table;
    $requete .= " WHERE ".$values;
    $q = $bdd->prepare($requete);

    if($DEBUG_DELETE) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_DELETE) var_dump($q->errorInfo());
            return true;
        }else{
            if($DEBUG_DELETE) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        if($DEBUG_DELETE) var_dump($q->errorInfo());
        $q->execute();
    }
}

// Méthode RSA
function generateKeyPair($privateKeyPath, $publicKeyPath) {
    $config = array(
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    );

    // Générer la paire de clés
    $res = openssl_pkey_new($config);

    // Extraire la clé privée
    openssl_pkey_export($res, $privateKey);
    file_put_contents($privateKeyPath, $privateKey);

    // Extraire la clé publique
    $publicKeyDetails = openssl_pkey_get_details($res);
    $publicKey = $publicKeyDetails['key'];
    file_put_contents($publicKeyPath, $publicKey);

    return array(
        'private_key' => $privateKey,
        'public_key' => $publicKey,
    );
}

// Génération des clés si elles n'existent pas déjà
$privateKeyPath = 'private.pem';
$publicKeyPath = 'public.pem';

if (!file_exists($privateKeyPath) || !file_exists($publicKeyPath))
    $keyPair = generateKeyPair($privateKeyPath, $publicKeyPath);

function encryptPassword($password, $publicKeyPath) {
    $publicKey = openssl_pkey_get_public(file_get_contents($publicKeyPath));
    openssl_public_encrypt($password, $encryptedPassword, $publicKey);
    return base64_encode($encryptedPassword);
}

function decryptPassword($encryptedPasswordBase64, $privateKeyPath) {
    $privateKey = openssl_pkey_get_private(file_get_contents($privateKeyPath));
    $encryptedPassword = base64_decode($encryptedPasswordBase64);
    openssl_private_decrypt($encryptedPassword, $decryptedPassword, $privateKey);
    return $decryptedPassword;
}
?>