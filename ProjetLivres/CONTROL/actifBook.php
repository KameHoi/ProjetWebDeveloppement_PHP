<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
// Page d'affichage des utilisateurs

require_once('../MODEL/Model.php');
$books = Model::load("books");
$authors = Model::load("authors");

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
if(isset($_POST['id'])){
    $id = $_POST["id"];
}

$books->updateActif($actif, $id);
//include_once ('../VIEW/Fonctions/function.php');
//debug($books);

header('Location: book.php');

