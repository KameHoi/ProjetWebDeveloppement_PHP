<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
//verif de la modif du livre
    require('../MODEL/Model.php');
    require('../VIEW/form.php');

    $_SESSION['error'] = 0;
    $books = Model::load("books");
    $authors = Model::load('authors');
    $books->read2();
    $authors->read2();



    //recoit de manage book

//verification de l'existence des varibles; verif que l'on a pas essayé de modif l'auteur ou le nom du livre (avec une lecture+ concordance dans la bd)
// faire l'update de la bd

//echo " session du bouton: ".$_SESSION['buttonActif'];


//recuperation des données en cas de champs vide
if(empty($_POST['label']) && isset($_SESSION['label'])){
    $_POST['label'] = $_SESSION['label'];
}
if(empty($_POST['author']) && isset($_SESSION['auth'])){
    $_POST['author'] = $_SESSION['auth'];
}
if(empty($_POST['quantity']) && isset($_SESSION['quantity'])){
    $_POST['quantity'] = $_SESSION['quantity'];
}
if(empty($_POST['price']) && isset($_SESSION['price'])){
    $_POST['price'] = $_SESSION['price'];
}

if(empty($_POST['id']) && isset($_SESSION['id'])){
    $_POST['id'] = $_SESSION['id'];
}
if(empty($_POST['img']) && isset($_SESSION['img'])){
    $_POST['img'] = $_SESSION['img'];
}



//si les variables existent
    if(isset($_POST['label']) && (isset($_POST['author'])) && isset($_POST['quantity']) && isset($_POST['price'])  && isset($_POST['id'])){
        //et si elles ne sont pas vide. Quantite peu etre vide ou negatif(ex: vol remarqués suite à un inventaire)
      /* echo "label ".$_POST['label'];
        echo " aut ".$_POST['author'];
        echo " qtt ".$_POST['quantity'];
        echo " prix ".$_POST['price'];
        echo ' boutoooon '.$_POST['buttonActif'].' fin bouton ';
        echo ' id '.$_POST['id'].' ';
        echo ' image '.$_POST['img'];*/


        if(!empty($_POST['label']) && (!empty($_POST['author'])) && !empty($_POST['quantity']) && ( $_SESSION['price'] >= 0)){
            //passage des variables $_ en $
            $label = htmlspecialchars($_POST['label']);
            $auth = htmlspecialchars($_POST['author']);
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];

            $id = $_POST['id'];
            $img = $_POST['img'];

            $idauthor = 0;
//debut des verifs de bases
            if($quantity < 0 || $price < 0){
                $_SESSION['error'] = 5;
                header('Location: manageBook.php');
            }else{

            //recuperation de l'id de l'auteur pour la modification du livre
            foreach ($books->data as $j) {
                foreach ($authors->data as $a) { // affiche pour livre 1 et 2 l'auteur 1 et pour livre 3 et 4 l'auteur 2
                        if ($auth == $a->label) {
                            $idauthor = $a->id;
                        }
                    }
                }

            //lecture en bd pour verifier que les livres correspondent toujours avec l'auteur
            $books->read2('', "label ='$label' && id = '$id' ");
            $authors->read2('', "label='$auth'");


            if(($books->data == true && $authors->data == true)) {
              //  livre et auteur sont ok, on modifie qtt,imag ou prix";


                if($quantity != $_SESSION['quantity'] || $price != $_SESSION['price'] || $img != $_SESSION['img'] ){
                    //modification du livre en db
                    $books->editBook($label,$quantity,$price,$idauthor, $img);
                    //lecture en db pour vérifier que la modif est bien faite
                    $books->read2('', "label ='$label' && id = '$id' && img = '$img' && price = '$price' && stock = '$quantity' ");

                    if ($books->data == true){
                        //l'edition est réalisée
                         $_SESSION['editOK'] = 1;
                         header('Location: book.php');

                    }else{
                        //l'édition a échouée
                        $_SESSION['error'] = 10;
                        header('Location: manageBook.php');
                    }

                }else{
                    //il n'y a eu aucune demande de modification sur la qtt, le prix ou l'image
                    $_SESSION['error'] = 11;
                    header('Location: manageBook.php');
                }


//ca fonctioone ce if
//echo '  le prix:  '.$price;
//echo ' idauthor: '.$idauthor;


                //unset($_POST['price']);

            }
             else if(($books->data == false && $authors->data == true)){
                 //on veut modif un titre ici donc erreur et retour sur book
                 //titre intouchable';
                 $_SESSION['error'] = 7;
                 header('Location: manageBook.php');

              }else if(($books->data == false && $authors->data == false)){
               // on essaye de creer un nouvel auteur et un nouveau livre. Si l'utilisateur arrive jusque la, il est renvoyé sur la page d'ajout de livre
                $_POST['error'] = 3;
                header('Location: addBook.php');
            }else if(($books->data == true && $authors->data == false)){
                 //on ne peut pas modifier un auteur non plus
                 $_SESSION['error'] = 6;
                 header('Location: manageBook.php');
             }
            }
        }else{
            // il y a une variable vide
            $_SESSION['error'] = 1;
            header('Location: manageBook.php');
        }

    }else{
        // erreur dans la reception des variables
        $_SESSION['error'] = 4;
        header('Location: manageBook.php');

    }



?>