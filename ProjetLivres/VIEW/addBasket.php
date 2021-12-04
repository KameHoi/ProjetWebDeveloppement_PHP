
<?php
// Affichage d'un message d'alert si on essaye d'ajouter un livre non disponible !!
if ((isset($_SESSION['livreEtat'])) && ($_SESSION['livreEtat'] == false))           // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
{
    echo '
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong> Le livre n\'est pas disponible !
            </div>';

    unset($_SESSION['livreEtat']);      // Supprimer la variable
}
// Affichage d'un msg d'erreur en cas de stock inférieur à la demande
if ((ISSET($_SESSION['livreStock'])) && ($_SESSION['livreStock'] == false))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
{
    echo '
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong> La quantité en stock n\'est pas suffisante !
            </div>';

    unset($_SESSION['livreStock']);      // Supprimer la variable
}

// Affichage d'un msg d'erreur en cas de postNumber == 0
//debug($_POST);
if ((ISSET($_SESSION['postNumberLivre'])) && ($_SESSION['postNumberLivre'] == false))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
{
    echo '
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong> La quantité doit être supérieur à 0 !
            </div>';

    unset($_SESSION['postNumberLivre']);      // Supprimer la variable
}

?>

<div id="messages"></div>
<?php

if(isset($_SESSION['error'])){
    if($_SESSION['error'] == 1){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Votre quantité doit être superieur à 0
              </div>';
    }
}

if (isset($_SESSION['addBookPanierSuccess']))
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Votre livre a bien été ajouté au panier !
          </div>';
    unset($_SESSION['addBookPanierSuccess']);
}