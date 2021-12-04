<?php
//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {
    //echo 'votre type de compte est : '.$_SESSION["typeCount"];
    ?>


        <h2>Changement de mot de passe :</h2>
    <?php
        //if isset session error
        if (ISSET($_SESSION['ERROR']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
        {
            echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Une erreur s\'est produite !</p>';
            unset($_SESSION['ERROR']);      // Supprimer la variable
        }
        elseif (ISSET($_SESSION['passwordIdentique']))
        {

            echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Votre nouveau mot de passe doit être différent de l\'ancien</p>';
            unset($_SESSION['passwordIdentique']);      // Supprimer la variable
        }
        elseif (ISSET($_SESSION['passwordInf4']))
        {

            echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Votre mot de passe doit contenir au moins 4 caractères !</p>';
            unset($_SESSION['passwordInf4']);      // Supprimer la variable
        }

        function chargerClasse($classe)
        {
            require '../VIEW/Fonctions/' . $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
        }

        spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

        if (!ISSET($_SESSION['SUCCESS'])) {
echo "<div  style='width:350px'>";
            // Création du formulaire :
            $form2 = new Form('', '', 'post', 'changePassword.php', '');
            //Ancien mot de passe
            $form2->setPassword('* Entrez votre mot de passe :', 'oldPassword', 'oldPassword', 'oui', '******', '', 'password', 'form-control input-lg');
            //Password
            $form2->setPassword('* Entrez votre nouveau mot de passe :', 'password', 'password', 'oui', '', '', 'password', 'form-control', '', 'resultatPassword');
            //Repeat Password
            $form2->setPassword('* Répétez le mot de passe :', 'password2', 'password2', 'oui', '', '', 'password', 'form-control');

            // Submit
            $form2->setSubmit('', 'Envoyer', 'disabled', 'btn btn-lg btn-primary btn-block');

            $getForm = $form2->getForm();
            echo $getForm.'</div>';

        } else {
            echo '<p class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>Le changement de mot de passe a été effectué !</p>';
            unset($_SESSION['SUCCESS']);
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