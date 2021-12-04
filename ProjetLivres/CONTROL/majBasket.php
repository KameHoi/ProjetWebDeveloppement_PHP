<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once('../VIEW/Fonctions/function.php');
require_once('../VIEW/Fonctions/Basket.php');
$panier = new Basket();

?>

    <li class="nav-item">
    <a class="nav-link" href="basket.php"><i class="fas fa-shopping-cart"></i> Panier


<?php
if (isset ($_SESSION['panier']))
{
?><small><span id="countNbrElementPanier">(<?php echo $panier->countNbrElementsPanier() ?>)</span>
    <div>
        Total: <?php echo number_format($panier->total(), 2, ',', ' '); ?> €</small>
    </div>
<?php
}
?>

    </a></li>
