<?php
$title = "Modifier un post";

include('controllers/user/isConnectedSecurity.php');
require_once('models/modelPost.php');
require_once('models/modelUser.php');

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_SESSION['pseudo'])) {
    $postId = $_GET['id'];
    $userPseudo = $_SESSION['pseudo'];
    $userId = $_SESSION['id'];

    if (CheckIfPostExists($db, $postId)) {
        if (IsPostFromUser($db, $postId, $userId)) {
            $postInfos = GetPostWithId($db, $postId)->fetch();
        } else {
            $errorMsg = "Ce post ne vous appartient pas";
        }
    } else {
        $errorMsg = "Ce post n'existe pas";
    }
} else {
    $errorMsg = "Vous n'avez pas sélectionné de post à modifier";
}

if (isset($_POST['validate'])) {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        //Récupère les données du formulaire
        $postTitle = nl2br(htmlspecialchars($_POST['title']));
        $postContent = nl2br(htmlspecialchars($_POST['content']));
        //Insertion du post
        ModifyPost($db, $postId, $postTitle, $postContent);
        header('Location:index.php?page=myPost');
        $successMsg = "Post modifié";
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}