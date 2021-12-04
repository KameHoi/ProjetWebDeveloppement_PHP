<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}


require_once('core.php');
//require_once('../VIEW/header.php');
require_once ('typeCount.php');
require_once ('../VIEW/Fonctions/function.php');
require_once('../VIEW/Fonctions/Basket.php');

$panier = new Basket();

$books = Model::load("books");
//debug ($_POST);

if ((isset($_POST['id'])) && (isset($_POST['price'])) && (isset($_POST['number'])))
{
    $products = $books->query('SELECT * FROM books where id =:id', array('id' => $_POST['id']));

    if (empty($products))
    {
        $_SESSION['Error'] = true;
        exit();
    }
    if (!(isset($_SESSION['quantityPanier'][$products[0]->id])))
    {
        //echo 'session vide <br\>';
        $_SESSION['quantityPanier'][$products[0]->id] = 0;
    }


    // On vérifie l'état du livre si il est disponible ou pas !!!
    if ($products[0]->actif == 0)
    {
        // livreEtat c'est pour afficher un message d'erreur en cas de non activité du livre
        $_SESSION['livreEtat'] = false;

        //echo $_SESSION['livreEtat'];

//        header('Location: book.php');

    }


    elseif ($_POST['number'] <= 0)
    {
        $_SESSION['postNumberLivre'] = false;

        //echo $_SESSION['postNumberLivre'];

  //      header('Location: book.php');
    }

    // On vérifie si la quantité disponible dans le stock est suffisante pour l'achat
    elseif (($products[0]->stock >= ($_POST['number'] +  $_SESSION['quantityPanier'][$products[0]->id])))
    {

        $panier->add($products[0]->id);

        $_SESSION['pricePanier'][$products[0]->id] = $_POST['price'];

        $_SESSION['insertOrderDetail'] = true;

        $_SESSION['addBookPanierSuccess'] = true;
    //    header('Location: book.php');

        //die('Le livre a bien été ajouté à votre panier <a href="javascript:history.back()"> retourner en arrière</a> ');


    }

    else {

        // livreStock c'est pour afficher un message d'erreur en cas de stock pas suffisant
        $_SESSION['livreStock'] = false;

        //echo $_SESSION['livreStock'];

      //  header('Location: book.php');
    }
}
else
{
    $_SESSION['Error'] = true;
}

//var_dump($books->query($sql));


require_once('../VIEW/addBasket.php');
