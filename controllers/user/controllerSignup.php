<?php
$title = 'Inscription';

require_once('models/modelUser.php');
include('controllers/user/isDisconnectedSecurity.php');

if (isset($_POST['validate'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        //Récupère les données du formulaire
        $userPseudo = htmlspecialchars($_POST['pseudo']);
        $userEmail = htmlspecialchars($_POST['email']);
        $userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $userExists = GetUserFromPseudo($db, $userPseudo);
        $emailExists = GetUserFromEmail($db, $userEmail);

        if ($userExists->rowCount() == 0) {//Si le pseudo est libre
            if ($emailExists->rowCount() == 0) {//si le mail est libre
                if ($_POST['password'] == $_POST['password2']) {
                    InsertNewUser($db, $userPseudo, $userEmail, $userPassword);
                    header("Location: index.php?page=signin");
                } else {
                    $errorMsg = "Les mots de passe ne correspondent pas";
                }
            } else {
                $errorMsg = "Cet email est déjà pris";
            }
        } else {
            $errorMsg = "Ce pseudo est déjà pris";
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
