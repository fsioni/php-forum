<?php
require('database.php');

$query = file_get_contents("db_create.sql");

$dbCreation = $db->prepare($query);

if ($dbCreation->execute()){
    echo "Success";
}else{
    echo "Fail";
}
