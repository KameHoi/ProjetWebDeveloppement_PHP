<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once ('verifLastOrder.php');
require_once('../VIEW/header.php');
require_once ('../VIEW/Fonctions/function.php');
require_once ('typeCount.php');

// Affichage du top 10 des meilleurs ventes
$books = Model::load("books");
$sql = $books->query('SELECT books.label, SUM(orderdetails.quantity) as quantityTotal
FROM orderdetails 
JOIN books on books.id = orderdetails.idBook
GROUP BY books.label
ORDER BY quantityTotal DESC 
limit 10');


require_once('../VIEW/main.php');
require_once('../VIEW/footer.php');

?>
