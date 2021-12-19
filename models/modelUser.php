<?php

function GetUserFromPseudo($db, $pseudo){
    $user = $db->prepare("SELECT * FROM Users WHERE pseudo = ?");
    $user->execute(array($pseudo));
    return $user;
}

function GetUserFromEmail($db, $email){
    $user = $db->prepare("SELECT * FROM Users WHERE email = ?");
    $user->execute(array($email));
    return $user;
}

function InsertNewUser($db, $pseudo, $email, $password){
    $insert = $db->prepare("INSERT INTO Users(pseudo, email, password, lastSeen) VALUES(?,?,?,?)");
    $lastSeen = date("Y-m-d H:i:s");
    $insert->execute(array($pseudo, $email, $password, $lastSeen));
}

function ChangeLastSeen($db, $pseudo){
    $lastSeen = date("Y-m-d H:i:s");
    $query = $db->prepare("UPDATE Users SET lastSeen = ? WHERE pseudo = ?");
    $query->execute(array($lastSeen, $pseudo));
}