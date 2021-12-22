<form method="get" class="mt-4 mb-2">
    <div class="form-group row mb-4">
        <div class=" col-8 mb-2">
            <input type="search" class="form-control" name="search" placeholder="Rechercher"
                   value="<?= $search ?? ''; ?>">
        </div>
        <div class="col-4">
            <select class="form-select" name="sortBy">
                <option disabled <?php if (!isset($sort)) echo 'selected' ?>>Trier par</option>
                <option value="1" <?php if (isset($sort) && $sort == 1) echo 'selected' ?>>Du plus récent au plus
                    ancien
                </option>
                <option value="2" <?php if (isset($sort) && $sort == 2) echo 'selected' ?>>Du plus ancien au plus
                    récent
                </option>
                <option value="3" <?php if (isset($sort) && $sort == 3) echo 'selected' ?>>Three</option>
            </select>
        </div>
        <div class="col-4">
            <button class="btn btn-success" type="submit">Rechercher</button>
        </div>
    </div>
</form>
<?php if (isset($searchResult)) { ?>
    <h3 class="mb-4">Résultats pour '<?= $search ?>'</h3>
    <?php
    if ($searchResult->rowCount() == 0) {
        echo "<h5>Aucun résultat pour cette recherche</h5>";
    }
    while ($post = $searchResult->fetch()) {
        echo GetPostCard($db, $post['id'], $post['title'], $post['content'], $post['date'], $post['views'], $post['author_id'], FALSE, FALSE);
    } ?>
<?php } else { ?>
    <h3 class="mb-4">Derniers posts</h3>
    <div id="allPosts">
        <?php
        if ($lastsPosts->rowCount() == 0) {
            echo "<h5>Aucun post</h5>";
        }
        while ($post = $lastsPosts->fetch()) {
            echo GetPostCard($db, $post['id'], $post['title'], $post['content'], $post['date'], $post['views'], $post['author_id'], FALSE, FALSE);
        } ?>
    </div>
<?php } ?>


