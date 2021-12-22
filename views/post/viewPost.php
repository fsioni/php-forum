<?php if (isset($postInfos)) { ?>
    <br><br>
    <h3><?= $postInfos['title'] ?></h3>
    <hr>
    <p><?= $postInfos['content'] ?></p>
    <hr>
    <p>Publié par <a
                href="index.php?page=profile&id=<?= $postInfos['author_id'] ?>"><strong><?= $authorPseudo ?? '' ?></strong></a>,
        le <?= DBDateToOutput($postInfos['date']) ?></p>
    <p class="fw-lighter">Nombre de vues : <?= $views ?></p>
    <hr>
    <?php if (isset($_SESSION["auth"])) { ?>
        <form method="post">
            <div class="mb-3">
                <label class="fw-bolder" for="content" class="form-label">Ajouter un commentaire</label>
                <textarea class="form-control" name="content" placeholder="Commentaire" required></textarea>
            </div>
            <button type="submit" name="validate" class="btn btn-primary">Commenter</button>
        </form>
    <?php }
}
    if ($comments->rowCount() > 0) echo '<br><h4>Commentaires</h4>';
    while ($comment = $comments->fetch()){
    echo GetCommentCard($db, $comment['author_id'], $comment['content'], $comment['date'], FALSE,$comment["post_id"], $comment['id']);
    }

?>
