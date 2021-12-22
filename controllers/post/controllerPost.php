<?php

$title = 'Afficher un post';
require_once('models/modelPost.php');
require_once('models/modelUser.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idPost = $_GET['id'];

    if (CheckIfPostExists($db, $idPost)) {
        $postInfos = GetPostWithId($db, $idPost)->fetch();
        $authorPseudo = GetPseudoFromID($db, $postInfos['author_id']);
        IncrementViews($db, $idPost);
        $views = GetViews($db, $idPost);
        $comments = GetCommentsFromPostId($db, $idPost);
    } else {
        $errorMsg = "Ce post n'existe pas";
    }
} else {
    $errorMsg = "Vous n'avez pas sélectionné de post";
}

if (isset($_POST['validate'])) {
    $content = htmlspecialchars($_POST['content']);
    AddComment($db, $idPost, $_SESSION['id'], $content);
    header("Refresh:0");
}