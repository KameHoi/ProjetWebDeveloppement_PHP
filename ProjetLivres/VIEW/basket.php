<?php
//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {
//echo 'votre type de compte est : '.$_SESSION["typeCount"];
?>

    <h2>Panier</h2>
<?php
if ((ISSET($_SESSION['livreStock'])) && ($_SESSION['livreStock'] == false))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
        {
            echo '
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong> La quantité en stock n\'est pas suffisante !
            </div>';

            unset($_SESSION['livreStock']);      // Supprimer la variable
        }

if ((ISSET($_SESSION['postNumberLivre1'])) && ($_SESSION['postNumberLivre1'] == false))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
        {
            echo '
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong> La quantité doit être supérieur à 0 !
            </div>';

            unset($_SESSION['postNumberLivre1']);      // Supprimer la variable
        }
?>
<form method="post" action="basket.php">


    <table class = 'table  table-hover'>
        <thead>
        <tr>

            <th class="name">Titre du livre</th>
            <th class="quantity">Quantité en stock</th>
            <th class="price">Prix</th>
            <th class="quantity">Quantité</th>
            <th class="action">Actions</th>

        </tr>
        </thead>


        <tbody>

        <?php

        //debug($_SESSION);

        foreach ($products as $product):

        // Vérification changement de quantité :

            if (isset($_POST['quantityModif'])) {

                if ($_POST['quantityModif'][$product->id] <= 0){
                    $_SESSION['postNumberLivre1'] = false;

                    header('Location: basket.php');

                }

                elseif ($product->stock < $_POST['quantityModif'][$product->id])
                {
                    $_SESSION['livreStock'] = false;

                    header('Location: basket.php');

                }
                else {


                    $_SESSION['quantityPanier'][$product->id] = $_POST['quantityModif'][$product->id];

                    header('Location: basket.php');

                }
        }


        ?>

        <tr>
            <td class="name"><?php echo $product->label; ?></td>
            <td class="stock"><?php echo $product->stock; ?></td>
            <td class="price"><?php echo number_format($_SESSION['pricePanier'][$product->id], 2, ',', ''); ?> €</td>
            <td class="quantity">
                <input type="number" onblur="" name="quantityModif[<?php echo $product->id ?>]"  value="<?php echo $_SESSION['quantityPanier'][$product->id] ?>">
                <input type="submit" class="btn btn-primary" value="Recalculer">


            </td>
            <td class="action"><a class="action"><a href="basket.php?del=<?php echo $product->id; ?>"><div class="text-danger" ><i class="fas fa-trash-alt"></i></div></a></td>

            <?php endforeach; ?>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td class="total" colspan="2" align="right"><div class="font-weight-bold">Total :</div></td>
            <td class="totalPrice" colspan="3"><span class="font-weight-bold"><?php echo number_format($panier->total(), 2, ',', ' '); ?> €</span></td>

                </form>

            </tr>
        </tfoot>

    </table>
    <?php
    if (!empty($_SESSION['panier'])) {
        ?>
        <div class="container" style="text-align: right; margin-top:30px">
            <a class="btn btn-success" href="validateOrder.php"><i class="fas fa-check"></i> Valider la commande</a>
        </div><br \>

    <?php
    }
    ?>
    </div>
    </div>
    </article>
    </section>
    <?php
}
else {

    header('Location: page1.php');
}
?>