<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}


require_once('core.php');
require_once('../VIEW/header.php');
require_once ('typeCount.php');
require_once ('../VIEW/Fonctions/function.php');
require_once('../VIEW/Fonctions/Basket.php');


//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {
//echo 'votre type de compte est : '.$_SESSION["typeCount"];


    $panier = new Basket();


    if (isset ($_SESSION['panier']))
    {


        require_once ('orders.php');

        if (isset($_GET['del'])) {
            $_SESSION['delOrderDetail'] = $_GET['del'];
            $panier->del($_GET['del']);
            header('Location: basket.php');

        }


        require_once('../VIEW/basket.php');

                }
    else { ?>
        <?php echo '<div  class="alert alert-secondary text-center font-weight-light-bold" role="alert">Votre panier est vide ! </div>';?>

        <?php
    }

    require_once('../VIEW/footer.php');

}
else {

    header('Location: page1.php');
}
?>