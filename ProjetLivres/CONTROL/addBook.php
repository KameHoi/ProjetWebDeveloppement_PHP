<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
require('../MODEL/Model.php');

//$_SESSION['error'] = 0;
$_SESSION['ajoutOK'] = 0;
$books = Model::load("books");
$authors = Model::load('authors');
$authors->read2();
$books->read2();
$idAut =0;
$similaire = 0;

//dans le cas ou l'utilisateur arrive à ajouter un nouveau livre alors qu'il veut effectuer une modification
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    switch($error){
        case 3: echo "Vous avez été redirigé dans la création de livre";
    }

}

//on vérifie que les variables du formulaire existent
if (isset($_POST['label']) && (isset($_POST['author'])) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['buttonActif']) && isset($_POST['image']))      // On vérifie que les variable existent et ne sont pas vide
{//on vérifie que les variables sont remplies, à l'exception de l'image qui peut être vide
    if(!empty($_POST['label']) && (!empty($_POST['author'])) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['buttonActif']) /*&& !empty($_FILES['img'])*/){
       //vérification des valeurs de prix et de quantité
        if($_POST['quantity'] < 0 || $_POST['price'] < 0){
            $_SESSION['error'] = 5;
            header('Location: manageBook.php');
        }else {

            //////////////////////////////////////////////
            //regexp du nom de l'auteur
            $auth = htmlspecialchars($_POST['author']);
            //si l'auteur ne correspond pas à la regexp
            if (preg_match("#[^a-zA-ZÀ-ú\s]#", "$auth")) {
                $_SESSION['error'] = 9;
                header('Location: manageBook.php');
            } else {

                $actif = $_POST['buttonActif'];
                if ($actif == "actif") {
                    $actif = 1;
                } else {
                    $actif = 0;
                }

                //passage des variables $_ en $
                $label = htmlspecialchars($_POST['label']);

                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $img = $_POST['image'];

                //lecture en db
                /////////////////////////////////////
                foreach ($authors->data as $j) {
                    if ($j->label == $auth) {
                        $idAut = $j->id;
                    }
                }
                ///////////////////////


                $books->read2('', "label ='$label' && idAuthor = '$idAut'");
                $authors->read2('', "label='$auth'");


                /////$books->data PERMET DE SAVOIR SI ON A UNE REPONSE    LA BD EST VIDE ON RENTRE DANS LE ELSE POURN LAJOUTER sinon livre existant
                /// verificiation de non concordance entre un titre de livre et un auteur. Evite les doublons.

                /// Si le livre existe ET si l'auteur existe alors ==> erreur, livre existant, message d'erreur et renvoie sur manageBook
                if (($books->data == true && $authors->data == true)) {

                    $_SESSION['error'] = 2;
                    header('Location: manageBook.php');

                } else if ($authors->data == true && $books->data == false) {
                   // auteur connu, livre inconnu==>  recuperation de l'id de l'auteur pour l'add puis creation du livre ";

                    //recuperation de l'id de l'auteur
                    foreach ($authors->data as $j) {
                        if ($j->label == $auth) {
                            $idAut = $j->id;
                            //echo " id auteur: ".$idAut;
                        }
                    }

                    //ajout du livre en bd
                    $books->addBook($label, $quantity, $price, $actif, $idAut, $img);


                    //$books->read2('', "label ='$label' and idAuthor = '$idAut'");
                    //if($books->data == true){

                    //verif ajout livre
                    $books->read2('', "label ='$label' && idAuthor = '$idAut'");
                    $authors->read2('', "label='$auth'");
                    if ($books->data == true && $authors->data == true) {
                        // livre ajouté";
                        $_SESSION['ajoutOK'] = 1;
                        header('Location: book.php');
                    } else {
                        // livre pas  ajouté";
                        $_SESSION['error'] = 8;
                        header('Location: manageBook.php');
                    }





                    //}
                    //header sur une page qui confirme la mise en db ou une erreur
                } else if (($authors->data == false && $books->data == true) || ($authors->data == false && $books->data == false)) {
                    echo " auteur inconnu, livre connu==> creation d'un auteur, recuperation de l'id puis creation d'un new livre ";
                    //echo "OU livre inconnu, auteur inconnu==> idem";
                    //creation de l'auteur
                    $authors->addAuthors($auth);
                    $authors->read2('', "label='$auth'");
//verif si l'auteur a bien été ajouté
                    if ($authors->data == false) {
                        $_SESSION['error'] = 3;
                        header('Location: manageBook.php');
                    } else {
                        foreach ($authors->data as $k) {
                            //   echo "je suis dans le foreach";
                            if ($k->label == $auth) {
                                $idAut = $k->id;
                                //     echo " id auteur: ".$idAut;
                            }
                        }

                        //creation du livre
                        $books->addBook($label, $quantity, $price, $actif, $idAut, $img);

                        //$books->read2('', "label ='$label' and idAuthor = '$idAut'");
                        //if($books->data == true){

                        //verif ajout livre quand new auteur
                        $books->read2('', "label ='$label' && idAuthor = '$idAut'");
                        $authors->read2('', "label='$auth'");
                        if ($books->data == true && $authors->data == true) {
                            // echo "livre ajouté";
                            $_SESSION['ajoutOK'] = 1;
                            header('Location: book.php');
                        } else {
                            $_SESSION['error'] = 8;
                            header('Location: manageBook.php');
                            // echo "livre pas  ajouté";
                        }


                        //$_SESSION['ajoutOK'] = 1;
                        //header('Location: book.php');
                    }



                } else {
                    //echo 'erreur";
                }
            }//fin du if quantité <= 0
        }
        }else{
        //echos a degager, juste balancer les erreurs et les afficher dans manageBook
        $_SESSION['error'] =1;
        //   echo "vos données ne peuvent pas êtres vide";
        header('Location: manageBook.php');
    }


} else {
    //  echo "une variable n'existe pas";
    $_SESSION['error'] = 4;
    header('Location: manageBook.php');
}




//petit retour en arriere avec la mention livre crée ou erreur de création du livre

