<?php

/**
 * Insert un post
 * @param PDO $db La base de données liée
 * @param int $author_id L'id de l'auteur du post
 * @param string $title Le titre du post
 * @param string $content Le contenu du post
 * @return void
 */
function InsertPost(PDO $db, int $author_id, string $title, string $content): void
{
    $date = date("Y-m-d H:i:s");
    $insert = $db->prepare("INSERT INTO Posts(author_id, title, content, date, status) VALUES (?,?,?,?,'Open')");
    $insert->execute(array($author_id, $title, $content, $date));
}

/**
 * Retourne les posts de l'utilisateur ayant l'ID en paramètre
 * @param PDO $db
 * @param string $id
 * @return PDOStatement
 */
function GetPostsFromAuthorID(PDO $db, string $id): PDOStatement
{
    $posts = $db->prepare("SELECT * FROM Posts WHERE author_id = ? ORDER BY id DESC");
    $posts->execute(array($id));
    return $posts;
}

/**
 * Retourne vrai si le post en paramètre correspond à l'utilisateur ayant l'ID en paramètre, non sinon
 * @param PDO $db
 * @param string @$postId
 * @param string $userId
 * @return bool
 */
function IsPostFromUser(PDO $db, string $postId, string $userId): bool
{
    $post = $db->prepare("SELECT author_id FROM Posts WHERE id = ? && Posts.author_id = ?");
    $post->execute(array($postId, $userId));
    return ($post->rowCount() > 0);
}

/**
 * Supprime le post ayant l'ID en paramètre
 * @param PDO $db
 * @param string $id
 * @return void
 */
function DeletePost(PDO $db, string $id): void
{
    $delete = $db->prepare("DELETE FROM Posts WHERE id = ?");
    $delete->execute(array($id));
}

/**
 * Retourne vrai si le post ayant l'ID en paramètre existe, non sinon
 * @param PDO $db
 * @param string $id
 * @return bool
 */
function CheckIfPostExists(PDO $db, string $id): bool
{
    $check = $db->prepare("SELECT id FROM Posts where id = ?");
    $check->execute(array($id));
    return ($check->rowCount() > 0);
}

/**
 * Retourne les informations du post ayant l'ID passé en paramètre
 * @param PDO $db
 * @param string $id
 * @return array
 */
function GetPostWithId(PDO $db, string $id): PDOStatement
{
    $post = $db->prepare("SELECT * FROM Posts where id = ?");
    $post->execute(array($id));
    return $post;
}

/**
 * Modifie les informations du post avec les nouvelles passées en paramètre
 * @param PDO $db
 * @param string $postId
 * @param string $postTitle
 * @param string $postContent string
 * @return void
 */
function ModifyPost(PDO $db, string $postId, string $postTitle, string $postContent): void
{
    $update = $db->prepare("UPDATE Posts SET title = ?, content = ? WHERE id = ?");
    $update->execute(array($postTitle, $postContent, $postId));
}

/**
 * Retourne les 10 posts les plus récents
 * @param PDO $db
 * @return PDOStatement
 */
function GetLastPosts(PDO $db): PDOStatement
{
    return $db->query("SELECT * FROM Posts ORDER BY id DESC LIMIT 0, 10");
}

/**
 * Recherche la chaîne de caractère $search dans le titre ou le contenu des posts en les triant selon $orderBy
 * @param PDO $db
 * @param string $search
 * @param string $orderBy
 * @return PDOStatement
 */
function SearchPosts(PDO $db, string $search, string $orderBy): PDOStatement
{
    return $db->query('SELECT * FROM posts WHERE LOWER(title) LIKE LOWER("%' . $search . '%") OR LOWER(content) LIKE LOWER("%' . $search . '%") ' . $orderBy);
}

/**
 * Retourne les 5 derniers posts de l'utilisateur passé en paramètre
 * @param PDO $db
 * @param string $userId
 * @return PDOStatement
 */
function GetLastPostsFromUser(PDO $db, string $userId): PDOStatement
{
    $lastPosts = $db->prepare("SELECT * FROM Posts WHERE author_id = ? ORDER BY id DESC LIMIT 0, 5");
    $lastPosts->execute(array($userId));
    return $lastPosts;
}

function GetLastCommentsFromUser(PDO $db, string $userId): PDOStatement
{
    $lastPosts = $db->prepare("SELECT * FROM Comments WHERE author_id = ? ORDER BY id DESC LIMIT 0, 5");
    $lastPosts->execute(array($userId));
    return $lastPosts;
}

/**
 * Incrémente les vues du post entré en paramètre de 1
 * @param PDO $db
 * @param int $id
 * @return void
 */
function IncrementViews(PDO $db, int $id): void
{
    $increment = $db->prepare("UPDATE Posts SET views = views + 1 WHERE id = ?");
    $increment->execute(array($id));
}

/**
 * @param PDO $db
 * @param int $id
 * @return int Le nombre de vues du post
 */
function GetViews(PDO $db, int $id): int
{
    $views = $db->prepare("SELECT views FROM Posts WHERE id = ?");
    $views->execute(array($id));
    return $views->fetch()['views'];
}

/**
 * @param PDO $db
 * @param int $idPost
 * @param int $idAuthor
 * @param string $content
 * @return bool Si le commentaire a bien été posté
 */
function AddComment(PDO $db, int $idPost, int $idAuthor, string $content): bool
{
    $date = date("Y-m-d H:i:s");
    $add = $db->prepare("INSERT INTO Comments(author_id, post_id, content, date) VALUES (?,?,?,?)");
    return $add->execute(array($idAuthor, $idPost, $content, $date));
}

function GetCommentsFromPostId(PDO $db, int $id):PDOStatement
{
    $comments = $db->prepare("SELECT * FROM Comments WHERE post_id = ?");
    $comments->execute(array($id));
    return $comments;
}