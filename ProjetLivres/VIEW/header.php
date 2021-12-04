<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

require_once('../VIEW/Fonctions/function.php');
require_once('../VIEW/Fonctions/Basket.php');
$panier = new Basket();

?>
    <!DOCTYPE html>

    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Livres</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <script src="https://kit.fontawesome.com/9b9e4fe389.js"></script>


        <link rel="stylesheet" href="../VIEW/CSS/style.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>



        <script type="text/javascript" src="../VIEW/JS/listener.js"></script>
        <!-- Custom styles for this template -->


    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-info bg-light "  id="haut">
    <div class="container-fluid">
        <button class="navbar-toggler bg-iconnav" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="main.php">
            <img src="../VIEW/Images/logo.png" width="55" height="55" class="d-inline-block align-top" alt="">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav m-auto">
                <li class="nav-item active"><a class="nav-link" href="main.php"><i class="fas fa-home"></i> Acceuil</a></li>
                <li class="nav-item"><a class="nav-link" href="parametres.php"><i class="fas fa-user-cog"></i> Paramètres</a></li>
                <li class="nav-item"><a class="nav-link" href="listUsers.php"><i class="fas fa-users"></i> Employées</a></li>
                <li class="nav-item"><a class="nav-link" href="book.php"><i class="fas fa-list-ul"></i> Livres</a></li>
                        <div id="resultatDuPanier">

                        </div>

            </ul>
        </div>
            <?php
            if ((isset($_SESSION["UTILISATEUR_OK"])) && ($_SESSION["UTILISATEUR_OK"] == 1)) {

                //echo '<p> Bienvenue ' . $_SESSION["UTILISATEUR_NOM"]["username"] . '</p>';
                $_SESSION['connecte'] = true;
                echo '
                
                <ul class="nav navbar-nav right">
                    <li><a class="btn btn-success" href="../CONTROL/Deconnexion.php" ><i class="fas fa-sign-out-alt"></i> Deconnexion</a> </li>
                </ul>';
            }

            ?>
        </div>


    </nav>

    <div class="container-fluid shadow-sm p-3 mb-5 bg-white border rounded">
        <section>
            <article>
                <div class='container-fluid border rounded'>


