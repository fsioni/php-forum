<nav class="navbar navbar-light navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">The Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == "Accueil") echo 'active' ?>" aria-current="page"
                       href="index.php">Accueil</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['auth'])) { ?>
                <span class="navbar-text">Vous êtes connecté en tant que  <strong><?= $_SESSION['pseudo'] ?></strong></span>
                <form class="d-flex">
                <a class="btn btn-outline-danger mx-2" href="controllers/logout.php">Déconnexion</a>
            <?php } else { ?>
                <form class="d-flex">
                <a class="btn btn-outline-primary" href="index.php?page=signup">Inscription</a>
                <a class="btn btn-outline-success mx-2" href="index.php?page=signin">Connexion</a>
            <?php } ?>
                </form>
        </div>
    </div>
</nav>