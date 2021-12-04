<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

$titre = 'Profile utilisateur : ';

require_once('core.php');
require_once('../VIEW/header.php');
require_once ('typeCount.php');


$users = Model::load("users");
// On lui envoie les données saisi et on affiche avec ajax le résultat
if ((isset($_GET['userProfile'])) && (!empty($_GET['userProfile']))) {
    $users->username = $_GET['userProfile'];


    $users->readPassword();
}

require_once('../VIEW/userProfile.php');
