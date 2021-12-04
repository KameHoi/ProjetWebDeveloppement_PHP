<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
// Page d'affichage des utilisateurs

require_once('core.php');
$users = Model::load("users");

// On lui envoie les données saisi et on affiche avec ajax le résultat

    if (isset($_POST["actif"]))
    {

    $actif = $_POST["actif"];

    }
    else if (isset($_POST["desactive"]))
    {

        $actif = $_POST["desactive"];
    }
    else
    {
        $actif = 0;
    }
    $username = $_POST["utilisateur"];
    //echo 'ici'. $username;
    $users->updateActif($actif, $username);


header('Location: listUsers.php');

