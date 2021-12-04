<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once('core.php');

function typeCount(){
    //include_once ('../VIEW/Fonctions/function.php');
    //debug($_SESSION);
    if ((isset($_SESSION["UTILISATEUR_NOM"]["username"]))  || (!empty($_SESSION["UTILISATEUR_NOM"]["username"]))) {

        $usersTypeCount = Model::load("users");
        $usersTypeCount->username = $_SESSION["UTILISATEUR_NOM"]["username"];

        $usersTypeCount->readPassword();
        $_SESSION["typeCount"] = null;
        $actif = null;
        // Si $typeCount == 1 alors Admin. Si == à 2 alors employé. Sinon == 3 et donc ERROR. Si l'user n'est pas actif alors $typeCount == 3 DONC ERROR


        if ($usersTypeCount->data["actif"] == 1) {
            // Admin
            if ($usersTypeCount->data["idRole"] == 1) {
                $_SESSION["typeCount"] = 1;


            }
            // Employé
            else if ($usersTypeCount->data["idRole"] == 2) {
                $_SESSION["typeCount"] = 2;
            }
            // Error
            else {
                $_SESSION["typeCount"] = 3;
            }
        }
        // Inactif
        else {
            $_SESSION["typeCount"] = 3;
            $_SESSION["message"] = "<p class='msgErreur'> Votre compte est inactif</p>";
        }

    }
    else {
        $_SESSION["typeCount"] = 3;
        if (isset($_SESSION)) {

            $_SESSION["actif"] = false;

        }
    }
}
