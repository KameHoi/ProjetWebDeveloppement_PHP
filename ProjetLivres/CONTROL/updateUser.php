<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require_once('core.php');
// require model
//echo 'ici';
//if ((isset($_POST['usernameUpdate'])) && (isset($_POST['nameUpdate'])) && (isset($_POST['surnameUpdate'])) && (isset($_POST['passwordUpdate'])) && (!empty($_POST['usernameUpdate'])) && (!empty($_POST['nameUpdate'])) && (!empty($_POST['surnameUpdate'])) && (!empty($_POST['passwordUpdate'])))       // On vérifie que les variable existent et ne sont pas vide
//{

$username = htmlspecialchars($_POST['usernameUpdate']);

$users = Model::load("users");
$users->username = $username;
$users->readPassword();

if (!(isset($_POST['nameUpdate'])) || (empty($_POST['nameUpdate'])) || (strlen($_POST['nameUpdate']) < 4))
{
    $name = $users->data['name'];

    if (strlen($_POST['nameUpdate']) < 4)
    {
        $_SESSION['errorName'] = true;
    }

}
else
{
    $name = htmlspecialchars($_POST['nameUpdate']);
}

if (!(isset($_POST['surnameUpdate'])) || (empty($_POST['surnameUpdate'])) || (strlen($_POST['surnameUpdate']) < 4))
{
    $surname = $users->data['surname'];

    if (strlen($_POST['surnameUpdate']) < 4)
    {
        $_SESSION['errorSurname'] = true;
    }

}
else
{
    $surname = htmlspecialchars($_POST['surnameUpdate']);
}

if (!(isset($_POST['passwordUpdate'])) || (empty($_POST['passwordUpdate'])) || (strlen($_POST['passwordUpdate']) < 4))
{
    $password = $users->data['password'];
    if ((strlen($_POST['passwordUpdate']) < 4) && (!empty($_POST['passwordUpdate'])))
{
        $_SESSION['errorPassword'] = true;
    }
}
else
{
    $password = password_hash($_POST['passwordUpdate'], PASSWORD_BCRYPT);

}


    //$users->read('', "username = '$users->username'");



    //echo 'ici3';
    if (empty($users)) {

        $_SESSION['ERROR'] = 'true';

        //echo 'ici4';


    }

    else {

        $users->updateUser($name, $surname, $password);
        $_SESSION['SUCCESS'] = 'true';

        //echo 'ici5';

    }
//include_once ('../VIEW/Fonctions/function.php');
//debug($users);



header('Location: listUsers.php');
