<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require_once('core.php');
require_once('../VIEW/Fonctions/Basket.php');

include_once ('../VIEW/Fonctions/function.php');

$panier = new Basket();

// require model
$orders = Model::load("orders");

$sql = $orders->query('SELECT * FROM orders 
                        JOIN orderdetails on orders.id = orderdetails.idOrder
                        JOIN books on books.id = orderdetails.idBook 
                        where ((orders.basketDB = 1) and (orders.idUser = :idUser))', array('idUser' => $_SESSION["UTILISATEUR_NOM"]["id"]));

//echo 'Session : <br \>';
//debug($_SESSION);

//echo 'Orders : <br \>';

//echo '<br \><br \><br \><br \><br \><br \>id utilisateur : '.$_SESSION['UTILISATEUR_NOM']['id'].'<br \>';
foreach ($sql as $key => $value)
{

    //echo 'idOrder: '.$value->idOrder.'<br \>';

    //echo 'idBook : '.$value->idBook.'<br \>';
    $_SESSION['panier'][$value->id] = $value->idBook;
    //echo 'idBook de session: '.$_SESSION['panier'][$value->id].'<br \>';

    //echo 'Quantity : '.$value->quantity.'<br \>';
    $_SESSION['quantityPanier'][$value->id] = $value->quantity;
    //echo 'Quantity de session: '.$_SESSION['quantityPanier'][$value->id].'<br \>';

    //echo 'Price : '.$value->price.'<br \>';
    $_SESSION['pricePanier'][$value->id] = $value->price;
    //echo 'Quantity de session: '.$_SESSION['pricePanier'][$value->id].'<br \>';

    //debug($value);
}


