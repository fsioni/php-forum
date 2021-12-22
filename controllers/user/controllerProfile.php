<?php
require_once('models/modelPost.php');
require_once('models/modelUser.php');
$title = "Profil";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];
    $user = GetUserFromId($db, $userId);
    if ($user->rowCount() > 0) {
        $userInfo = $user->fetch();
        $title .= " de ".$userInfo['pseudo'];

        $lastPosts = GetLastPostsFromUser($db, $userId);
        $lastComments = GetLastCommentsFromUser($db, $userId);
    } else {
        $errorMsg = "Aucun n'utilisateur ne correspond";
    }
} else {
    $errorMsg = "Vous n'avez pas entré d'utilisateur";
}