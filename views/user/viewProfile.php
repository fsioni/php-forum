<?php
if (isset($userInfo)) { ?>
    <p class="fw-lighter">Dernière activité le <strong><?= DBDateToOutput($userInfo['lastSeen']) ?></strong></p>
    <h4 class="mt-4">Ses derniers posts</h4>

    <?php if ($lastPosts->rowCount() >0) {
        while ($post = $lastPosts->fetch()) {
            echo GetPostCard($db, $post['id'], $post['title'], $post['content'], $post['date'], $post['views'], $post['author_id'], TRUE, FALSE);
        }
    } else { ?>
        <p>Cet utilisateur n'a pas encore posté</p>
    <?php } ?>
    <br>
    <h4 class="mt-4">Ses derniers commentaires</h4>
    <?php if ($lastComments->rowCount() >0) {
        while ($comment = $lastComments->fetch()) {
            echo GetCommentCard($db, $comment['author_id'], $comment['content'], $comment['date'], TRUE, $comment['post_id'], $comment['id']);
        }
    } else { ?>
        <p class="text-muted">Cet utilisateur n'a pas encore commenté</p>
    <?php } ?>
<?php } ?>