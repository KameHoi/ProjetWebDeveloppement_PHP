<?php

if (($_SESSION["typeCount"] == 1)){
    ?>

        <h2>Création d'utilisateurs :</h2>
        <?php
        //if isset session error
        if (ISSET($_SESSION['ERROR']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
        {
            echo '<p class="msgErreur">Erreur de nom d\'utilisateur ou mot de passe !</p>';
            unset($_SESSION['ERROR']);      // Supprimer la variable
        }

        function chargerClasse($classe)
        {
            require '../VIEW/Fonctions/' . $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
        }

        spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
        echo '
        
            <div  style="width:350px">
            ';
            // Création du formulaire :
            $form2 = new Form('', '', 'post', 'addUser.php', '');
    // Username
            $form2->setText('* Nom d\'utilisateur :', 'username', 'username', 'oui', 'Nom d\'utilisateur', '', 'text', 'form-control', '', 'resultatUsername');
    //Password
            $form2->setPassword('* Mot de passe :', 'password', 'password', 'oui', '******', '', 'password', 'form-control', '', 'resultatPassword');
    //Repeat Password
            $form2->setPassword('* Répétez le mot de passe :', 'password2', 'password2', 'oui', '******', '', 'password', 'form-control', '', 'resultatPassword2');
    //Nom
            $form2->setText('* Nom :', 'surname', 'surname', 'oui', 'Nom', '', 'text', 'form-control', '', 'resultatSurname');
            // Prenom
            $form2->setText('* Prénom :', 'name', 'name', 'oui', 'Prénom', '', 'text', 'form-control', '', 'resultatName');
    // Submit
            $form2->setSubmit('', 'Envoyer', 'disabled', 'btn btn-lg btn-primary btn-block');

            $getForm = $form2->getForm();
        echo $getForm.
            '</div>';
        ?>
    </article>
    </section>

<?php
}
else {
    $_SESSION["message"] = "<p class='msgErreur'> Vous n'êtes pas autorisé à accéder à cette page.</p>";
    header('Location: page1.php');
}
?>