<?php
require(__DIR__.'/../../includes/config-db.php');

try {
    session_start();
    $db = new PDO('mysql:host='.SERVER.';dbname='.DB.';charset=utf8mb4;', USER, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    die('Une erreur a été trouvée '.$e->getMessage());
}

