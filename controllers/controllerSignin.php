<?php
$title = "Connexion";

require ('models/modelUser.php');
include('controllers/isDisconnectedSecurity.php');

if (isset($_POST['validate'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        //Récupère les données du formulaire
        $userPseudo = htmlspecialchars($_POST['pseudo']);
        $userPassword = $_POST['password'];

        $userExists = GetUserFromPseudo($db, $userPseudo);

        if ($userExists->rowCount() > 0) {//Si le pseudo est libre
            $userInfos = $userExists->fetch();
            if (password_verify($userPassword, $userInfos['password'])) {
                $_SESSION['auth'] = TRUE;
                $_SESSION['pseudo'] = $userPseudo;
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