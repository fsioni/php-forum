<?php
$title = "Connexion";

require_once('models/modelUser.php');//pour les actions sur l'utilisateur
include('controllers/user/isDisconnectedSecurity.php');

if (isset($_POST['validate'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        //Récupère les données du formulaire
        $userPseudo = htmlspecialchars($_POST['pseudo']);
        $userPassword = $_POST['password'];

        //Vérifie si l'utilisateur existe
        $userExists = GetUserFromPseudo($db, $userPseudo);

        if ($userExists->rowCount() > 0) {//Si le pseudo est correct
            $userInfos = $userExists->fetch();
            if (password_verify($userPassword, $userInfos['password'])) {//Si les mdp correspondent
                //Authentification de l'utilisateur
                $_SESSION['auth'] = TRUE;
                $_SESSION['pseudo'] = $userPseudo;
                $_SESSION['id'] = $userInfos['id'];
                ChangeLastSeen($db, $userPseudo);
                header("Location: index.php");
            } else {
                $errorMsg = "Le mot de passe est incorrect";
            }
        } else {
            $errorMsg = "Ce pseudo n'existe pas";
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}