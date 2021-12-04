<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require('../MODEL/Model.php');
$books = Model::load("books");
$author = Model::load("authors");
$addOK = 0;
$_SESSION['error'] = 0;
//verification du form dans book
//verificaton des variables , mise des variables en session dans l'attente de la validation du panier
//envoie sur manage book en cas de modif ou d'ajout et envoie sur book.hp en cas d'erreur


// pour l'ajout des livres dans le panier
if(isset($_POST['send'])){
    if(isset($_POST['number']) && $_POST['number'] > 0 && isset($_POST['id'])){
       //tableau pour conserver les données avant envoie au panier?
        echo"a que coucou les gens je suis dans le SEND";

        $_SESSION['send'] = $_POST['send'];
    }
    else{
        unset($_POST['send']);
        $_SESSION['error'] = 1;
        header('Location: book.php');
    }
    //block ajout de livre
}
    else if(isset($_POST['add'])){
        //un header sur manageBook avec le formulaire de creation du livre

        $_SESSION['add'] = $_POST['add'];
        header('Location:manageBook.php');
        }
    //block modification du livre
        else if(isset($_POST['edit']) /*&& !isset($_POST['send'])*/ && isset($_POST['auth']) && isset($_POST['label']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['buttonActif']) && isset($_POST['id']) && isset($_POST['img'])){
            //un header sur manage book mais avec les champs préremplis



            if(isset($_SESSION['add'])){
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['send'])){
                unset($_SESSION['send']);
            }
            ////////////////////////////
            //affichages à effacer
            //recupere bien l'id du livre pour pouvoir preremplir les champs de la modif
            echo "autheur du livre".$_POST['auth'];

            echo " id ".$_POST['id'];
            echo "label ".$_POST['label'];
            echo " aut ".$_POST['auth'];
            echo " qtt ".$_POST['quantity'];
            echo " prix ".$_POST['price'];
            echo ' bouton '.$_POST['buttonActif'];
            echo ' image '.$_POST['img'];
            //////////////////////////////////////
//permet d'envoyer les sessions sur manageBook
            $_SESSION['edit'] = $_POST['edit'];
            $_SESSION['auth'] = $_POST['auth'];
            $_SESSION['label'] = $_POST['label'];
            $_SESSION['price']= $_POST['price'];
            $_SESSION['quantity'] = $_POST['quantity'];
            $_SESSION['buttonActif'] = $_POST['buttonActif'];
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['img'] = $_POST['img'];
         header('Location:manageBook.php');
        }
else{
    echo "error"; //retour sur book avec message d'erreur. Idem pour un nombre entré </= 0 dans send
}


?>