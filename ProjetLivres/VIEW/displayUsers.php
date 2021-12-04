<?php
//
$_SESSION["tmpUsername"] = $_POST['username'];
if ($sql) {
    //include_once "../VIEW/Fonctions/function.php";
    //debug($_SESSION);

    echo "      
            <h2>Liste des employés</h2>
            <table class = 'table table-hover'>
                <thead>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Role</th>
                        <th>Statut</th>
                    </tr>
                </thead>
            
                <tbody>";
                    // On parcours la db pour afficher les utilisateurs.
                    foreach ($sql as $key=>$utilisateurs) {
                    // clé
                    $idUtilisateur = 'utilisateur'.$key;
                    echo "
                        <tr  onclick='changeEtatActive(this)'>
                    
                            <td class='font-weight-bold text-center'>";
                            if (($_SESSION["typeCount"]  == 1)) {

                                echo "
                                  
                                     <a href='userProfile.php?userProfile=" . $utilisateurs->username . "'> " . $utilisateurs->username . "</a></td>
                                    ";
                            }
                            else {
                                echo "
                                ".$utilisateurs->username."</td>
                            
                                     ";
                            }
                            echo "
                                <td>".$utilisateurs->surname."</td>
                                <td>".$utilisateurs->name."</td>
                                <td>".$utilisateurs->label ."</td>
                                <td>
                                    ";
                                if ($utilisateurs->actif == 0)
                                {
                                    echo "<p class='font-weight-bold '>Inactif</p>";
                                }
                                else if ($utilisateurs->actif == 1)
                                {
                                    echo "<p class='font-weight-bold '>Actif</p>";
                                }

                                // On vérifie que l'utilisateur est admin, et que la personne à désactiver n'est pas Admin
                                if (($_SESSION["typeCount"]  == 1) && ($utilisateurs->label != 'Admin')) {

                                    echo "
                                            <form name='general' method='post'>
                                
                                            <input type='hidden' name='utilisateur' id ='" . $idUtilisateur . "' value='" . $utilisateurs->username .  /* pour savoir quel utilisateur désactiver */
                                            "' >             
                                            <div class='checkbox text-right '>
                                                <input type='checkbox' name='name-checkbox'";

                                                // On vérifie en DB que l'utilisateur est actif, pour checké par défault la checkbox ou non.
                                                if ($utilisateurs->actif == 1) {
                                                    echo "checked='checked'";
                                                }
                                                echo "
                                                        />
                                                    <label >";
                                                if ($utilisateurs->actif == 1) {
                                                    echo "Désactiver";
                                                }
                                                else
                                                {
                                                    echo "Activer";
                                                }


                                                echo "
                                                 </label>
                                            </div> 
                                    
                                            </form>";
                                }
                                echo "
                            
                            
                                </td>
                    
                        </tr>";

                    }
                echo "
                </tbody>
            </table>
        </div>
        
    </article>
</section>";
}
elseif (empty($_POST['username']))
{
    echo ' <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Le champ est vide !
    </div>';
}
else
{
    echo ' <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        L\'utilisateur <strong>'.$_POST['username'].'</strong> n\'existe pas !
    </div>';
}
//include_once ('../VIEW/Fonctions/function.php');
//debug($_POST);

?>



