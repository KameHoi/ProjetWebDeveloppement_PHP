<?php
// Page d'affichage des utilisateurs
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once('core.php');

require_once ('typeCount.php');

$users = Model::load("users");

$sql = null;
// On lui envoie les données saisi et on affiche avec ajax le résultat
if ((isset($_POST['username'])) && (!empty($_POST['username']))) {
    //$users->username = $_POST['username'];

    //$users->selectUsers();
    $username = $_POST['username'].'%';

    // On vérifie le type de compte. Si c'est l'admin on affiche tous les comptes. Si c'est un employé, on affiche seulement les actifs
    if (($_SESSION["typeCount"]  == 1)) {

        $sql = $users->query('SELECT * FROM users JOIN roles on roles.id = users.idRole WHERE username LIKE :username', array('username' => $username));
    }
    else if (($_SESSION["typeCount"]  == 2)) {
        $sql = $users->query('SELECT * FROM users JOIN roles on roles.id = users.idRole WHERE username LIKE :username and users.actif=1', array('username' => $username));

    }

    //include_once ('../VIEW/Fonctions/function.php');
    //debug($sql);
}

require_once('../VIEW/displayUsers.php');