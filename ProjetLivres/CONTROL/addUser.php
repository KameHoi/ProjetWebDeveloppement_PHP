<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require_once('core.php');


// require model
if ((isset($_POST['username'])) && (isset($_POST['password'])) && (isset($_POST['surname'])) && (isset($_POST['name'])) && (isset($_POST['password2'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])) && (!empty($_POST['password2'])) &&  (!empty($_POST['name'])) &&  (!empty($_POST['surname'])) && (preg_match("/^([a-zA-ZÀ-ú\-0-9]{4,36})$/" ,$_POST['username'])) && ($_POST['password'] == $_POST['password2']) && (strlen($_POST['password']) > 3) && (strlen($_POST['name']) > 3) && (strlen($_POST['surname']) > 3))       // On vérifie que les variable existent et ne sont pas vide
{
    /* Mettre les variables du POST en $ */

    $username = htmlspecialchars($_POST['username']);
    // Pour hash
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $name = htmlspecialchars($_POST['name']);

    $surname = htmlspecialchars($_POST['surname']);

    $users = Model::load("users");

    $users->username = $_POST['username'];

    $users->read('', "username = '$users->username'");

    if( ($users->data) || (htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))) {

        //echo 'ici';
        $_SESSION['ERROR'] = 'true';

    } else {
        //echo 'ici2';
        $_SESSION['addUserOK'] = true;
        $users->addUser($username, $password, $name, $surname);

/*
        $_SESSION["UTILISATEUR_NOM"] = $_POST['username'];
        $_SESSION["UTILISATEUR_OK"] = 1;
*/
    }


} else {

    $_SESSION['ERROR'] = 'true';
    //echo 'mauvais regex';
}
//include_once '../VIEW/Fonctions/function.php';
//debug($_POST);

header('Location: page1.php');
