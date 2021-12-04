<?php

if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
// On vérifie si le panier contient quelque chose avant de valider la commande.
if (!empty($_SESSION['panier'])) {

    require_once('core.php');
    require_once('../VIEW/header.php');
    require_once('typeCount.php');
    require_once('../VIEW/Fonctions/function.php');

    $orders = Model::load("orders");
    $books = Model::load("books");

    $idUser = $_SESSION['UTILISATEUR_NOM']['id'];
//debug($_SESSION);


// /!\ vérifier isset session de panier avant de traiter

//update de la quantité de book
    foreach ($_SESSION['panier'] as $key => $product) {
        //echo 'livre : '.$key. '<br \>';
        $sql2 = $books->query('select stock from books where id = :id', array('id' => $key));

        foreach ($sql2 as $value) {

            $stock = $value->stock - $_SESSION['quantityPanier'][$key];
            //echo 'stock de la '.$key.' :'. $stock.'<br \>';
            // Enregistrement dans la db de books

            try {


                $sqlUpdateStockBook = $books->query('
                    UPDATE books
                    SET books.stock = :quantity
                    WHERE (books.id = :id)', array(
                    'quantity' => $stock,
                    'id' => $key,

                ));

            } catch (Exception $e) {
                echo 'Une erreur est survenue lors de la récupération des données';
            }

        }

    }

// Update orders basketDB à 0
    try {

        $sql = $orders->query('UPDATE orders SET basketDB = :basketDB where ((orders.basketDB = 1) and (orders.idUser = :idUser))', array('basketDB' => 0, 'idUser' => $idUser));
        //$sql2 = $books->query('UPDATE books SET ')

        $_SESSION['CommandeOK'] = true;
    } catch (Exception $e) {
        echo 'Une erreur est survenue lors de la récupération des données';
    }
// On initialise id de Orders
    /*
    foreach ($sql as $value)
    {
        $idOrder = $value->id;

    }
    */
// Suppression des variables
    unset($_SESSION['pricePanier']);
    unset($_SESSION['panier']);
    unset($_SESSION['quantityPanier']);


    require_once('../VIEW/validateOrder.php');

}
// Vérification en cas d'ajout avec panier vide
else{
    echo 'Une erreur est survenue !! <br \> Vous serez redirigé dans 5 secondes';
    header('refresh:5;url=basket.php');

}