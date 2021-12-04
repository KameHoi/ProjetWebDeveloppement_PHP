<?php
// Page d'affichage des utilisateurs
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once('../MODEL/Model.php');
require('../VIEW/Form.php');
require('../VIEW/Fonctions/Basket.php');

require('../VIEW/Fonctions/function.php');

$books = Model::load("books");
$author = Model:: load('authors');
$books->read2();
$author->read2();

if ((isset($_POST['searchLabelBook']) && !empty($_POST['searchLabelBook'])) || (isset($_POST['searchAuth']) && !empty($_POST['searchAuth']))) {
echo "<script>console.log('je rentre dans mon if du contol');</script>";
    $books->selectBooksByLabel('', $_POST['searchLabelBook'], $_POST['searchAuth']);

    //Pour l'affichage en cas de retour sur la page

}

$panier = new Basket();




require_once('../VIEW/displayBook.php');
?>




