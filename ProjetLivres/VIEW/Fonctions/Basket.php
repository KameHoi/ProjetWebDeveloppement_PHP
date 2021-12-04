<?php


class Basket
{

    public function __onstruct($DB){
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (!isset($_SESSION['panier']))
        {
            $_SESSION['panier'] = array();
            $_SESSION['pricePanier'] = array();
            $_SESSION['quantityPanier'] = array();

        }

    }
    /**
     * add
     * @param $product_id
     */
    public function add($product_id)
    {
        // Vérification du panier
        if (isset ($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        }
        else {
            $_SESSION['panier'][$product_id] = 1;
        }
        // Vérification quantité
        if (isset ($_SESSION['quantityPanier'][$product_id])){

            $_SESSION['quantityPanier'][$product_id] = $_SESSION['quantityPanier'][$product_id] + $_POST['number'];
        }
        else {
            $_SESSION['quantityPanier'][$product_id] = $_POST['number'];
        }


    }

    /**
     * del
     * @param $product_id
     */
    public function del($product_id)
    {

        unset($_SESSION['panier'][$product_id]);
        unset($_SESSION['pricePanier'][$product_id]);
        unset($_SESSION['quantityPanier'][$product_id]);
    }

    /**
     * total
     */
    public function total(){

        $total = 0;

        foreach ($_SESSION['pricePanier'] as $key => $value){
            // Parcourt du tableau panier avec la clé
            $total =$total + ($value * $_SESSION['quantityPanier'][$key]);
        }
        return $total;
    }

    /**
     * Fonction qui calcule le nombre d'élément dans le panier.
     * @return float|int
     */
    public function countNbrElementsPanier()
    {
        return array_sum($_SESSION['quantityPanier']);
    }

}
