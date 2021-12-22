<?php
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)

require('models/database/database.php');
require_once('includes.php');
require_once('routes.php');

$controller = 'controllerIndex'; // contrôleur par défaut
$view = 'viewIndex'; // vue par défaut

include_once ('models/modelUser.php');
if(isset($_SESSION['auth'])) ChangeLastSeen($db, $_SESSION['pseudo']);

if (isset($_GET['page'])) {
    $nomPage = $_GET['page'];
    if (isset($routes[$nomPage])) {
        $controller = $routes[$nomPage]['controller'];
        $view = $routes[$nomPage]['view'];
    }
}
include('controllers/' . $controller . '.php');