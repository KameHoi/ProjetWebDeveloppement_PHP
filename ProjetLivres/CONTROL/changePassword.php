<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
include ('../VIEW/Fonctions/function.php');
require_once('core.php');
// require model

if ((isset($_POST['oldPassword'])) && (isset($_POST['password'])) && (isset($_POST['password2'])) && (!empty($_POST['oldPassword'])) && (!empty($_POST['password'])) && (!empty($_POST['password2'])))       // On vérifie que les variable existent et ne sont pas vide
{
    if (strlen($_POST['password']) < 4)
    {
        $_SESSION['passwordInf4'] = true;
    }
    else {


        // Pour hash
        $username = $_SESSION["UTILISATEUR_NOM"]["username"];
        $oldPassword = htmlspecialchars($_POST['oldPassword']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $users = Model::load("users");
        $users->username = $username;
        $users->readPassword();
        //$users->read('', "username = '$users->username'");


        if (!empty($users) && (!password_verify($oldPassword, $users->data['password']))) {
            $_SESSION['ERROR'] = 'true';


        }
        elseif  (password_verify($_POST['password'], $users->data['password']))
        {
            $_SESSION['passwordIdentique'] = true;
        }
        elseif ((htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))) {

            $_SESSION['ERROR'] = 'true';


        } else {

            $users->updatePassword($password);
            $_SESSION['SUCCESS'] = 'true';


        }
    }
} else {

    $_SESSION['ERROR'] = 'true';


}



header('Location: parametres.php');
