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

// Initition des variables à stocker dans la DB

// On va aller chercher l'id des livres pour pouvoir les traiter :
if (isset ($_SESSION['panier']))
{

    $books = Model::load("books");

    $ids = array_keys($_SESSION['panier']);
    if (empty($ids)){
        $products = array();
    }
    else {
//debug($ids);
        $products = $books->query('SELECT * FROM books where id IN ('.implode(',',$ids).')');
//debug($products);
    }
}
else {
    $_SESSION['Error'] = true;
}

// on parcourt la DB pour enregistrer les variables
foreach ($products as $product){

    // $product->id c'est l' idBook
    // on insère la quantity de chaque livre
    $quantityProduct[$product->id] = $_SESSION['quantityPanier'][$product->id];
    $priceBook[$product->id] = $_SESSION['pricePanier'][$product->id];
}

$idUser = $_SESSION['UTILISATEUR_NOM']['id'];
$label = 'commande';




// Enregistrement dans la DB de orders

// On récupère le dernier enregistrement
$sql = $orders->query('SELECT * FROM orders LEFT JOIN orderdetails on orderdetails.idOrder = orders.id where ((orders.basketDB = 1) and (orders.idUser = :idUser))', array('idUser' => $idUser));
// On initialise id de Orders
foreach ($sql as $value)
{
    $idOrder = $value->id;
    $idOrderTmp = $idOrder;
}


//echo $idOrder;
if (count($sql)==0){

    //echo 'insertion d\'une nouvelle commande';

    try
    {
        $sqlInsertOrder = $orders->query('       
            INSERT INTO orders 
            (label, date_create, idUser, basketDB) VALUES (:label, NOW(), :idUser, :basketDB)', array('label' => $label, 'idUser' => $idUser,'basketDB' => 1));


// Recupération de l'id de la dernière commande
         $idOrder = $orders->lastInserted;

//debug($_SESSION);
         foreach ($_SESSION['panier'] as $key => $product)
         {

             //echo 'idLivre : '.$key.' <br \>';
             //echo 'quantité : '.$_SESSION['quantityPanier'][$key].' <br \>';
             //echo 'prix : '.$_SESSION['pricePanier'][$key].' <br \>';

// Enregistrement dans la db de orderdetails
             try
             {

                 $sqlInsertOrderDetails1 = $orders->query('
                    INSERT INTO orderdetails
                    (idOrder, idBook, quantity, price) VALUES (:idOrder, :idBook, :quantity , :price)',array(
                     'idOrder' => $idOrder,
                     'idBook' => $key,
                     'quantity' => $_SESSION['quantityPanier'][$key],
                     'price' => $_SESSION['pricePanier'][$key]
                 ));


             }

             catch ( Exception $e)
             {
                 echo 'Une erreur est survenue lors de la récupération des données';
             }

         }

        unset($_SESSION['insertOrderDetail']);
    }

    catch ( Exception $e)
    {
        echo 'Une erreur est survenue lors de la récupération des données';
    }

    if (isset($idOrderTmp))
    {
        $idOrder = $idOrderTmp;
    }
}

elseif (count($sql)>=1) {

    foreach ($_SESSION['panier'] as $key => $product) {

// Enregistrement dans la db de orderdetails

        try {
            foreach ($sql as $value) {

                if (($key == $value->idBook) && ($value->quantity != $_SESSION['quantityPanier'][$key])) {
                    $sqlUpdateOrderDetails = $orders->query('
                    UPDATE orderdetails
                    JOIN orders on orders.id = orderdetails.idOrder
                    SET orderdetails.quantity = :quantity
                    WHERE (orders.basketDB = 1) and (orderdetails.idBook = :idBook)', array(
                        'quantity' => $_SESSION['quantityPanier'][$key],
                        'idBook' => $key,

                    ));

                    unset($_SESSION['insertOrderDetail']);
                    //echo 'Update alors d\'un nouveau livre dans une même commande';

                }


            }

        } catch (Exception $e) {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }


        // Le cas d'un ajout d'un nouveau livre, dans une même commande. On crée une session lors de l'ajout et on l'efface lors de n'importe quel accès à la db
        if (isset($_SESSION['insertOrderDetail'])) {

            $sqlInsertOrderDetails = $orders->query('
                                       INSERT INTO orderdetails
                                         (idOrder, idBook, quantity, price) VALUES (:idOrder, :idBook, :quantity , :price)', array(
                'idOrder' => $idOrder,
                'idBook' => $key,
                'quantity' => $_SESSION['quantityPanier'][$key],
                'price' => $_SESSION['pricePanier'][$key]
            ));
            unset($_SESSION['insertOrderDetail']);
            //echo 'insertion alors d\'un nouveau livre dans une même commande';
        }

        // Le cas d'une suppression d'un article. Il faut le supprimer de la db, on crée une session de suppression qu'on supprime à chaque accès à la DB

        if (isset($_SESSION['delOrderDetail'])) {

            $sqlInsertOrderDetails = $orders->query('
                                       DELETE 
                                       FROM orderdetails
                                       WHERE (idOrder = :idOrder) and (idBook = :idBook)
                                       ', array(
                'idOrder' => $idOrder,
                'idBook' => $_SESSION['delOrderDetail'],

            ));
            unset($_SESSION['delOrderDetail']);
            //sd 'delete du livre';
        }
}

/*

*/
//echo $idOrder;
