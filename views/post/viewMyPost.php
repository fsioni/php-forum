<?php
if ($posts->rowCount() == 0) { ?>
    <br><br>
    <h4>Vous n'avez pas encore publié de post</h4>
    <a href="index.php?page=addPost" class="btn btn-primary">Ajouter un post</a>
<?php } ?>

<?php while ($post = $posts->fetch()) {
    echo GetPostCard($db, $post['id'], $post['title'], $post['content'], $post['date'], $post['views'], $post['author_id'], FALSE, TRUE);
} ?>

<div class="modal fade" id="deletePostModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel">Voulez-vous vraiment supprimer ce post ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                <a href="" id="boutonConfirmer" class="btn btn-success">Confirmer</a>
            </div>
        </div>
    </div>
</div>

<script>
    let deletePostModal = document.getElementById('deletePostModal')
    deletePostModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let idPost = button.getAttribute('data-bs-id')
        let modalConfirmButton = deletePostModal.querySelector('#boutonConfirmer')

        modalConfirmButton.href = "controllers/post/deletePost.php?id=" + idPost
    })
</script>
