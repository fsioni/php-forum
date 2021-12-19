<?php
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)

require('models/database.php');
require_once('includes/includes.php');
require_once('includes/routes.php');

$controller = 'controllerIndex'; // contrôleur par défaut
$view = 'viewIndex'; // vue par défaut

if (isset($_GET['page'])) {
    $nomPage = $_GET['page'];
    if (isset($routes[$nomPage])) {
        $controller = $routes[$nomPage]['controller'];
        $view = $routes[$nomPage]['view'];
    }
}
include('controllers/' . $controller . '.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= $title . ' - ' . SITENAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body class="bg-light">