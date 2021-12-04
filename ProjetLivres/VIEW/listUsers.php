
    <?php


// Pour vérifier qui a accès à l'ajout d'utilisateur. 1 pour admin, 2 pour employé, 3 pour inactif.
if (($_SESSION["typeCount"] == 1)) {
    ?>

    <h2>Employés</h2>
<div class="container" style="text-align: right; margin-top:30px">
            <a class="btn btn-info" href="ajoutUser.php"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>
</div>
    <?php
}
if (($_SESSION["typeCount"] == 1) || ($_SESSION["typeCount"] == 2))
{
    ?>

    <!-- Pour executer la fonction de recherche au chargement de la page -->
    <script>
    window.onload = check;
    </script>
    <!-- -->
    <div  style="width:350px">
        <form method="POST">
            <div class="form-group">
                <label>Entrez un nom d'utilisateur : </label>
                <input class="form-control" onkeyup="check()"type="text" name="username" id="username" placeholder="Nom d'utilisateur"
                value="<?php
                // Pour réafficher la précédente recherche.
                if(isset($_SESSION["tmpUsername"]))
                {
                    echo htmlspecialchars($_SESSION["tmpUsername"]);
                    unset($_SESSION["tmpUsername"]);
                }
                ?>"  />
            </div>
            <div class="form-group">
                <input class="btn btn-lg btn-primary btn-block" type="button" name="submit" value="Rechercher" id="search" onclick="searchTrue()"  />
            </div>
        </form>

    </div>


    <?php
    //if isset session error
    if (ISSET($_SESSION['errorName']))          // Vérifier qu'il n'a pas déjà essayer de forcer la création en contournant js
    {
        echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Le prénom doit contenir minimum 4 lettres</p>';
        unset($_SESSION['errorName']);      // Supprimer la variable
    }
    if (ISSET($_SESSION['errorSurname']))
    {

        echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Le nom doit contenir minimum 4 lettres</p>';
        unset($_SESSION['errorSurname']);      // Supprimer la variable
    }
    if (ISSET($_SESSION['errorPassword']))
    {

        echo '<p class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                  Le mot de passe doit contenir au moins 4 caractères !</p>';
        unset($_SESSION['errorPassword']);      // Supprimer la variable
    }
    ?>
    <div id="messages">
        <!-- les employés -->
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

//include_once ('../VIEW/Fonctions/function.php');
//debug($_POST);
?>


