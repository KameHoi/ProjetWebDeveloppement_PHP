<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require_once('core.php');
include_once('../VIEW/Fonctions/function.php');

include_once("typeCount.php");
// require model
if ((isset($_POST['username'])) && (isset($_POST['password'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])))       // On vérifie que les variable existent et ne sont pas vide
{

    /* Mettre les variables du POST en $ */
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);


    $usersPassword = Model::load("users");
    $usersPassword->username = $username;
    $usersPassword->readPassword();


                if (!empty($usersPassword) && (!password_verify($password, $usersPassword->data['password']))) {
                    $_SESSION['ERROR'] = 'true';


                } else {
                    $_SESSION["UTILISATEUR_NOM"] = $usersPassword->data;
                    $_SESSION["UTILISATEUR_OK"] = 1;
                    $_SESSION['connecte'] = true;

                }


            } else {

                $_SESSION['ERROR'] = 'true';
}
header('Location: page1.php');
