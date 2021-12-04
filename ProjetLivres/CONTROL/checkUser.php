<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require_once('core.php');


if(!empty($_POST["username"]) && (isset($_POST['username'])))
{
    $users = Model::load("users");
    $users->username = $_POST['username'];
    //include_once ('../VIEW/Fonctions/function.php');
    //debug($users->data);
    $users->read('', "username = '$users->username'");

    if ($users->data) {

        echo "false";
    }
    else
    {
        echo "true";
    }

}
else {
    echo 'null';
}