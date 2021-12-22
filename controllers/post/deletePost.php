<?php
include(__DIR__ . '/../../models/database/database.php');
include(__DIR__ . '/../../models/modelUser.php');
include(__DIR__ . '/../../models/modelPost.php');

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_SESSION['pseudo'])) {
    $postId = $_GET['id'];
    if (IsPostFromUser($db, $postId, $_SESSION['id'])) {
        DeletePost($db, $postId);
    }
}
header('Location: ../../index.php?page=myPost');
