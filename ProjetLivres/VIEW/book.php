<?php
//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {
    //echo 'votre type de compte est : '.$_SESSION["typeCount"];
    ?>


    <h2>Les Livres</h2>
    <!-- Pour executer la fonction de recherche au chargement de la page -->
<script>
    window.onload = checkBook;
</script>


    <?php
    //######################### Affichage d'un message après la validation d'une commande.##########///

    //if isset session error
    if ((ISSET($_SESSION['CommandeOK'])))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
    {
        echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>Votre commande a bien été enregistré !</p>';
        unset($_SESSION['CommandeOK']);
    }

?>
<?php
// messages de confirmation d'un livre modifié ou ajouté
if (isset($_SESSION['editOK'])){
    $editOK = $_SESSION['editOK'];
    unset($_SESSION['editOK']);
    switch ($editOK) {
        case 1: echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>Votre livre a bien été modifié</div>'; break;
    }
}

if(isset($_SESSION['ajoutOK'])){
    $ajoutOK = $_SESSION['ajoutOK'];
    unset($_SESSION['ajoutOK']);
    switch ($ajoutOK){
        case 1: echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>Votre livre a bien été ajouté</div>'; break;
    }
}

?>

<div class="container" style="text-align: right; margin-top:30px">

    <?php
    //bouton d'ajout de livre
    $formAdd =  new form('formAdd','formAdd','post','checkBook.php');
    $formAdd->setSubmit('add', 'Ajouter un livre', '', 'btn btn-info');
    echo $formAdd->getForm();

    //recherche  par titre
    ?>
</div>

<div  style='width:180px'>
        <form method="POST">
            <div class="form-group">
                <label>Entrez un titre du livre : </label>
                <input class="form-control" onkeyup="checkBook()"type="text" name="searchLabelBook" id="searchLabelBook" placeholder="Titre"
                value="<?php
                // Pour réafficher la précédente recherche.
                if(isset($_SESSION["searchLabelBook"]))
                {
                    echo $_SESSION["searchLabelBook"];

                    unset($_SESSION["searchLabelBook"]);
                }
                ?>"  />
            </div>
            <div class="form-group">
                <input class="btn btn-md btn-primary btn-block" type="button" name="submit" value="Rechercher" id="search" onclick="searchTrueBook()"  />
            </div>
        </form>

        <?php
        //recherche par auteur
        $formSearchAut =  new form('formSearchAuth','formSearchAuth','post','');
        $formSearchAut->setText1('','searchAuth','searchAuth','','rechercher par auteur','','text','checkBook();');
        $formSearchAut->submit('searchAuth','Rechercher par auteur', '', 'btn btn-primary', 'search', 'searchTrueBook();');
        echo $formSearchAut->getForm();

        ?>
</div>
        <?php
//affichage de displayBook
        ?>

        <div id="messages"></div>

        <!--ne sert qu'a eviter que la table se retrouve sous le footer-->
        <table></table>
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