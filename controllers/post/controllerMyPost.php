<?php
include('controllers/user/isConnectedSecurity.php');
require_once('models/modelPost.php');//pour l'insertion du post
require_once('models/modelUser.php');//pour la récupération de l'id de l'auteur

$title = "Mes posts";

$posts = GetPostsFromAuthorID($db, $_SESSION['id']);