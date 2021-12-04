<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require('../VIEW/header.php');

require('../VIEW/Form.php');
require('../MODEL/Model.php');
$books = Model::load("books");
$books->read2();

$author = Model::load("authors");
$author->read2();

//$books->selectBooks();

require('../VIEW/book.php');

require('../VIEW/footer.php');
?>

<script type="text/javascript" src="../VIEW/JS/listenerPanier.js"></script>
<!-- Custom styles for this template -->
