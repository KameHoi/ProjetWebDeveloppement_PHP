<?php
//include_once('Fonctions/function.php');
//debug($_SESSION);
if (($_SESSION["typeCount"] == 1)) {
//echo 'votre type de compte est : '.$_SESSION["typeCount"];
?>

    <?php
            //include_once ('Fonctions/function.php');
            //debug($users);
if (!$users->data)
{
    ?>
    <div class='container' style='text-align: right; margin-top:30px'>
        <a class='btn btn-info' href='listUsers.php'><i class='fas fa-undo'></i> Retour à la page de recherche</a>
    </div>

    <br />
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        L'utilisateur n'existe pas !
    </div>
    <?php

}
else
{
    echo "
    <div class='container' style='text-align: right; margin-top:30px'>
                <a class='btn btn-info' href='listUsers.php'><i class='fas fa-undo'></i> Retour à la page de recherche</a>
    </div>
    
    <br />
                <table class = 'table  table-hover'>
                    <thead>
                        <tr>
                        
                            <th>Nom d'utilisateur</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Mot de passe</th>
                            
                        </tr>
                    </thead>
                
                
                    <tbody>
                        <tr>
                            <td><span class='font-weight-bold'>".$users->data['username']."</span></td>
                            <form method='post' action='updateUser.php'>
                                
                                    <input type='hidden' name='usernameUpdate' id='usernameUpdate' value='".$users->data['username']."' required />
                                
                                <td>
                                    
                                    <input type='text' class='form-control' name='surnameUpdate' id='surnameUpdate' value='".$users->data['surname']."' required />
                                </td>
                                <td>
                                    
                                    <input type='text' class='form-control' name='nameUpdate' id='nameUpdate' value='".$users->data['name']."' required />
                                </td>
                                <td>
                                    
                                    <input type='password' placeholder='********' class='form-control' name='passwordUpdate' id='passwordUpdate' />
                                </td>
                            
                                
                                <p></p>
                                 
                        </tr>
                    </tbody>
                </table><br />
                <input type='submit' class='btn btn-lg btn-primary btn-block' value='Envoyer' />
                            
                            </form><br />
                ";

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