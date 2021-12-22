<?php
/**
 * Nom du site
 */
const SITENAME = 'The Forum';

/**
 * Retourne la date entrée en paramètre sous la forme : "d/m/Y à H:m"
 * @param string $dbDate
 * @return string
 */
function DBDateToOutput(string $dbDate): string
{
    $date = date("d/m/Y", strtotime($dbDate));
    $date .= " à ";
    $date .= date("H:i", strtotime($dbDate));
    return $date;
}

/**
 * Retourne une card de post avec les valeurs en paramètres
 * @param PDO $db
 * @param int $id
 * @param string $title
 * @param string $content
 * @param string $date
 * @param int $views
 * @param int $author_id
 * @param bool $isOnProfile card sur le profil de l'utilisateur ?
 * @param bool $isMyPost card sur la page 'Mes posts' ?
 * @return string
 */
function GetPostCard(PDO $db, int $id, string $title, string $content, string $date, int $views, int $author_id, bool $isOnProfile = FALSE, bool $isMyPost = FALSE): string
{
    $pseudo = GetPseudoFromID($db, $author_id);
    $dateToFormat = DBDateToOutput($date);
    $postedByText = ($isOnProfile || $isMyPost) ? "<p class=\"text-muted\">Posté le $dateToFormat</p>" : "<p class=\"text-muted\">Posté par <a href=\"index.php?page=profile&id=$author_id\">$pseudo</a>, le $dateToFormat</p>";
    $authorButtons = $isMyPost ? "<a href=\"index.php?page=modifyPost&id=$id\" class=\"btn btn-success\">Modifier</a>
            <button type=\"button\" class=\"btn btn-danger\" data-bs-toggle=\"modal\"
                    data-bs-target=\"#deletePostModal\" data-bs-id=\"$id\">Supprimer
            </button>" : "";
    return "<div class=\"card text-center mb-3 col-8 mx-auto\">
                <div class=\"card-header\">
                    <h5>$title</h5>
                </div>
                <div class=\"card-body\">
                    <p class=\"card-title\">$content</p>
                </div>
                <div class=\"card-footer\">
                $postedByText
                <p class=\"fw-lighter\">Nombres de vues : $views</p>
                <a href=\"index.php?page=post&id=$id\" class=\"btn btn-primary\">Afficher</a>
                $authorButtons
                </div>
            </div>";
}

function GetCommentCard(PDO $db, int $authorId, string $content, string $date, bool $isOnProfile = FALSE, int $postId = -1, int $commentId = -1): string
{
    $authorPseudo = GetPseudoFromID($db, $authorId);
    $dateToFormat = DBDateToOutput($date);
    $viewButton = $isOnProfile ? "<a href=\"index.php?page=post&id=$postId#$commentId\" class=\"btn btn-primary\">Afficher</a>" : "";
    $postedByText = ($isOnProfile) ? "<p class=\"text-muted\">Posté le $dateToFormat</p>" : "<p class=\"text-muted\">Posté par <a href=\"index.php?page=profile&id=$authorId\">$authorPseudo</a>, le $dateToFormat</p>";
    return "<div class=\"card text-center mb-3 col-8 mx-auto\" id=\"$commentId\">
                <div class=\"card-body\">
                    <p class=\"card-title\">$content</p>
                </div>
                <div class=\"card-footer\">
                $postedByText
                $viewButton
                </div>
            </div>";
}