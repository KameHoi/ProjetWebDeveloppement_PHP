<?php
//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2)) {
//echo 'votre type de compte est : '.$_SESSION["typeCount"];
?>
        <?php

        //verification de l'existence de l'erreur et si elle existe, recuperation du numero

        $error = 0;
        if (isset($_SESSION['error']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
        {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);      // Supprimer la variable
        }
//affichage des messages d'erreur
        switch ($error){
            //add
            case 1: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Vos données doivent être remplis</div>'; break;
            case 2: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Votre livre existe deja</div>'; break;
            case 3: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>L\'ajout de l \'auteur a échoué</div>'; break;
            case 4: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Il y a un probléme dans la récéption de vos variables</div>'; break;
            case 5: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Votre quantité ou votre prix doit être superieur/égal à 0</div>'; break;
            case 8: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>L\'ajout de votre livre a échoué</div>'; break;
            case 9: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Votre auteur ne peut pas comporter de chiffres</div>';break;
            //edit
            case 6: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Un auteur est intouchable! Ne le modifiez pas.</div>'; break;
            case 7: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Le titre d\'un livre n\'est pas modifiable</div>'; break;
            case 10: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>La modification de votre livre a échoué</div>'; break;
            case 11: echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Vous n\'avez fait aucun changement</div>'; break;

        }

//ajout
        if(isset($_SESSION['add'])){
            echo "Ajouter un livre";
            $formAddBook =  new form('form','form','post','addBook.php'); //test URL
            //onKeyUp va vérifier si le combo titre+auteur n'existe pas
            $formAddBook->setText1('Titre','label','label','required','Titre du livre', '','text','');
            $formAddBook->setText1('Auteur','author','author','required','Nom-prénom','','text','');
            $formAddBook->setText1('Couverture','image','image', '', 'nom de l\'image du livre','','file','');
            $formAddBook->setNumber('Quantité', 'quantity', 'quantity', 'required', 'number', '','','');
            $formAddBook->setDecimal('Prix','price','price','required','number','','','');
            $formAddBook->setRadio('Actif','buttonActif','actif','','radio','actif','');
            $formAddBook->setRadio('Inactif','buttonActif','inactif','','radio','inactif','checked');
            $formAddBook->setSubmit('addBook', 'Ajouter', '', 'btn btn-info');
            echo $formAddBook->getForm();

            $formRetour = new form('form','form','post','book.php');
            $formRetour->setSubmit('return', 'Retour', '','btn btn-info');
            echo $formRetour->getForm();
//edition
        }else if(isset($_SESSION['edit'])){
            echo "Modifier le livre";

          if(isset($_SESSION['label']) && isset($_SESSION['auth']) && isset($_SESSION['quantity']) && $_SESSION['price'] && isset($_SESSION['buttonActif']) && isset($_SESSION['id'])){

                      $formEditBook =  new form('form','form','post','editBook.php');
                      //onKeyUp va vérifier si le combo titre+auteur n'existe pas
                      $formEditBook->setText1('Titre','label','label','',isset($_SESSION['label']) ? $_SESSION['label']:'','','text','verifAuthor();');
                      $formEditBook->setText1('Auteur','author','author','',isset($_SESSION['auth']) ? $_SESSION['auth']:'','','text','verifAuthor();');
                      echo '<div id = "divcomp"></div>';
                      $formEditBook->setText1('Couverture','img','img', '', isset($_SESSION['img']) ? $_SESSION['img']:'','','file','');
                      $formEditBook->setNumber('Quantité', 'quantity', 'quantity', '', 'number', '','', isset($_SESSION['quantity']) ? $_SESSION['quantity']:"3121");
                      $formEditBook->setDecimal('Prix','price','price','','number','','', isset($_SESSION['price']) ? $_SESSION['price']:'');
                      //$formEditBook->setRadio('Actif','buttonActif','actif','','radio','1','checked');
                      //$formEditBook->setRadio('Inactif','buttonActif','inactif','','radio','0','');
                      $formEditBook->hidden('','id','id','','hidden','','',isset($_SESSION['id']) ? $_SESSION['id']:'');
                      $formEditBook->setSubmit1('editBook', 'Modifier', 'verifButton();','button', 'btn btn-info');
                      echo $formEditBook->getForm();


              $formRetour = new form('form','form','post','book.php');
              $formRetour->setSubmit('return', 'Retour', '', 'btn btn-info');
              echo $formRetour->getForm();
          }



        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Erreur, veuillez contacter l\'administrateur</div>';

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