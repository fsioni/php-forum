<?php

/**
 * Récupère les informations d'un utilisateur à l'aide de son pseudo
 * @param PDO $db La base de données liée
 * @param string $pseudo Le pseudo de l'utilisateur recherché
 * @return PDOStatement Le résultat de la requête
 */
function GetUserFromPseudo(PDO $db, string $pseudo): PDOStatement
{
    $user = $db->prepare("SELECT * FROM Users WHERE pseudo = ?");
    $user->execute(array($pseudo));
    return $user;
}

/**
 * Récupère les informations d'un utilisateur à l'aide de son mail
 * @param PDO $db La base de données liée
 * @param string $email Le mail de l'utilisateur recherché
 * @return PDOStatement Le résultat de la requête
 */
function GetUserFromEmail(PDO $db, string $email): PDOStatement
{
    $user = $db->prepare("SELECT * FROM Users WHERE email = ?");
    $user->execute(array($email));
    return $user;
}

/**
 * Insert un nouvel utilisateur dans la base de données
 * @param PDO $db La base de données liée
 * @param string $pseudo Le pseudo du nouvel utilisateur
 * @param string $email Le mail du nouvel utilisateur
 * @param string $password Le mot de passe du nouvel utilisateur
 * @return void
 */
function InsertNewUser(PDO $db, string $pseudo, string $email, string $password): void
{
    $insert = $db->prepare("INSERT INTO Users(pseudo, email, password, lastSeen) VALUES(?,?,?,?)");
    $lastSeen = date("Y-m-d H:i:s");
    $insert->execute(array($pseudo, $email, $password, $lastSeen));
}

/**
 * Met à jour la date et l'heure où l'utilisateur a été actif la dernière fois
 * @param PDO $db La base de données liée
 * @param string $pseudo Le pseudo de l'utilisateur
 * @return void
 */
function ChangeLastSeen(PDO $db, string $pseudo): void
{
    $lastSeen = date("Y-m-d H:i:s");
    $query = $db->prepare("UPDATE Users SET lastSeen = ? WHERE pseudo = ?");
    $query->execute(array($lastSeen, $pseudo));
}

/**
 * Retourne le pseudo de l'utilisateur ayant l'ID en paramètre
 * @param PDO $db La base de données liée
 * @param string $userId
 * @return string Le pseudo
 */
function GetPseudoFromID(PDO $db, string $userId): string
{
    $query = $db->prepare("SELECT pseudo FROM Users WHERE id = ?");
    $query->execute(array($userId));
    $pseudo = $query->fetch();
    return $pseudo['pseudo'];
}

/**
 * Retourne les informations de l'utilisateur ayant l'ID en paramètre
 * @param PDO $db
 * @param string $userId
 * @return PDOStatement
 */
function GetUserFromId(PDO $db, string $userId): PDOStatement
{
    $user = $db->prepare("SELECT * FROM Users WHERE id = ?");
    $user->execute(array($userId));
    return $user;
}