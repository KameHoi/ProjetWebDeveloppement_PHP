
<?php
include_once('Fonctions/function.php');
//debug($_SESSION);
//if isset session error

?>

<?php

if (ISSET($_SESSION['ERROR']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
{
    echo '
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Erreur</strong> de nom d\'utilisateur ou mot de passe !
    </div>';

    unset($_SESSION['ERROR']);      // Supprimer la variable
}


?>



<?php
if (!isset($_SESSION['connecte'])) {

    function chargerClasse($classe)
    {
        require '../VIEW/Fonctions/' . $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
    }

    spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

    // Création du formulaire :
    ?>
    <img class="mb-4" src="../VIEW/Images/logo.png" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-sign-in-alt"></i> Veuillez vous connecter svp !</h1><br /><br />

    <div class="container" style="width:350px">

    <?php

    $form2 = new Form('', '', 'post', 'loginControl.php', 'form-signin');

    $form2->setText('* Entrez votre nom d\'utilisateur :', 'username', 'username', 'oui', 'Nom d\'utilisateur', '', 'username', 'form-control', '');
    //Password
    $form2->setPassword('* Entrez votre mot de passe :', 'password', 'password', 'oui', '******', '', 'password', 'form-control');

    // Submit
    $form2->setSubmit('', 'Envoyer', '', 'btn btn-lg btn-primary btn-block');

    $getForm = $form2->getForm();
    echo $getForm;

}
else
{

    // Affichage des differents messages d'erreurs
    if (isset($_SESSION["message"]))
    {
        echo $_SESSION["message"];
        unset($_SESSION["message"]);
///////////////////////////////////////////////////////////////////////////////

       echo ' <form action="deconnexion.php" method="post">
                     <input type="submit" value="Retour" name="returnPage1" class="btn btn-lg btn-primary">
        </form>';
////////////////////////////////////////////////////////////////////////////
    }
    else {

    echo '<p class="msgOK">Vous êtes déjà connecté !!</p>';
        header('Location: main.php');


    }
}

?>

</div>