<?php
require_once('models/modelPost.php');
require_once('models/modelUser.php');
$title = "Accueil";

$lastsPosts = GetLastPosts($db);

if ((isset($_GET['search']) && !empty($_GET['search'])) || isset($_GET['sortBy'])) {
    $search = htmlspecialchars($_GET['search']);
    $sort = $_GET['sortBy'] ?? '0';

    switch ($sort) {
        case 0:
        case 1:
            $orderBy = "ORDER BY id DESC";
            break;
        case 2:
            $orderBy = "ORDER BY id ASC";
            break;
    }

    $searchResult = SearchPosts($db, $search, $orderBy);
}