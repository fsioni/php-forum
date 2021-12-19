<?php
require('../includes/config-db.php');

try {
    session_start();
    $db = new PDO('mysql:host='.SERVER.';dbname='.DB.';charset=utf8;', USER, PASSWORD);
}catch(Exception $e){
    die('Une erreur a été trouvée '.$e->getMessage());
}

