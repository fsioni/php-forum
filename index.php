<?php
require_once 'statics/header.php';
require_once 'statics/navbar.php'; ?>
<br>

<main class="container">
    <h1><?= $title ?></h1>
    <?php
    if (isset($errorMsg)) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
    } elseif (isset($successMsg)) {
        echo '<div class="alert alert-success" role="alert">' . $successMsg . '</div>';
    }
    ?>

    <?php include('views/' . $view . '.php'); ?>
</main><br>

<?php require_once 'statics/footer.php'; ?>
