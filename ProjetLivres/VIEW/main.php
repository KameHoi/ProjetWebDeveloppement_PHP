<?php

if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {

    ?>
    <h2>Accueil</h2>

    <div>
            <h3 class="text-center">Bienvenue</h3>
    </div>
    <br \>

<?php
    //debug($_SESSION);
    if (ISSET($_SESSION['addUserOK']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
    {
    echo '<p class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        L\'utilisateur a bien été ajouté !</p>';
    unset($_SESSION['addUserOK']);      // Supprimer la variable
    }
?>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-auto">
                <p>Top 10 des meilleurs ventes de livres: <br \></p>
                <p>
                <table class = 'table  table-sm'>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //affichage du top 10 des meilleurs ventes


                    foreach ($sql as $key => $value)
                    {
                        ?>
                        <tr>
                            <td>
                        <?php

                        echo $value->label;
                        ?>
                            </td>
                            <td>
                        <?php
                        echo $value->quantityTotal;
                        ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                </p>
            </div>
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