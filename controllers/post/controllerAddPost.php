<?php
$title = "Ajouter un post";

include('controllers/user/isConnectedSecurity.php');
require_once('models/modelPost.php');//pour l'insertion du post
require_once('models/modelUser.php');//pour la récupération de l'id de l'auteur

if (isset($_POST['validate'])) {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        //Récupère les données du formulaire
        $postTitle = nl2br(htmlspecialchars($_POST['title']));
        $postContent = nl2br(htmlspecialchars($_POST['content']));

        //Insertion du post
        InsertPost($db, $_SESSION['id'], $postTitle, $postContent);
        header('Location:index.php?page=myPost');
        $successMsg = "Post publié";
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}