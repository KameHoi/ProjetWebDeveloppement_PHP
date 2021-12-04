
<div id="messagesRetour">
    <!-- les employés -->
</div>
<?php

$panier = new Basket();

// On supprime la variable Post'Number'; pour éviter un message d'erreur après modification du livre.
unset($_POST['number']);



if($books->data){

    $_SESSION['searchLabelBook'] = $_POST['searchLabelBook'];
    echo
    '<table class = "table  table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Image</th>
                            <th>Prix</th>
                            <th>Quantité en stock</th>
                             <th>Quantité demandée</th>
                            <th>Actif/inactif</th>
                        </tr>
                    </thead>
                    <tbody>';
//affichage du tableau
$auth = '';
    foreach ($books->data as $key=>$j) {
        //mise en tableau des données


        $idLivre = 'livre'.$key;
        $idLivre2 = 'livreID'.$key;
        $idLivreQuantity = 'livreQuantity'.$key;
        $idLivrePrice = 'livrePrice'.$key;

        // Retrun false pour empecher le comportement normal du bouton submit
        echo "<tr onsubmit='sendNumber(this)' 
            onclick='ActifOrInactif(this)'>";

        $labels = $j->label;
        //affichage du titre
        echo "<td>" . $j->label . "</td>";

        //recherche du nom de l'auteur à partir de l'idAuthor et de l'id de l'auteur
        $similaire = 0;
        foreach ($author->data as $a) { // affiche pour livre 1 et 2 l'auteur 1 et pour livre 3 et 4 l'auteur 2
            if ($similaire == 0) {
                if ($j->idAuthor == $a->id) {
                    echo "<td>" . $a->label . "</td>";
                    $auth = $a->label;
                    $similaire = 1;
                }
            }
        }

       //condition d'affichage d'une iamge
        if ($j->img == NULL){
            echo '<td> Aucune image disponible </td>';
        }else{
            echo '<td> <img src="../VIEW/images/'.$j->img.'"> </td>';
        }

        // Fonction number_format pour le prix
        echo "<td>" . number_format($j->price, 2, ',', '') . " euros </td>";
        echo "<td>" . $j->stock . "</td>";

        echo '<td>';
        ?>

        <form name="formBook" id="formBook" onsubmit="return false;"  method="post" class="">
            <input name="number" id="<?php echo $idLivreQuantity; ?>" required type="number" />
            <input name="id" id="<?php echo $idLivre2; ?>" type="hidden" value="<?php echo $j->id; ?>"/>
            <input name="price" id="<?php echo $idLivrePrice; ?>" type="hidden" value="<?php echo $j->price; ?>"/>
            <br \><br \>
            <input name="send" id="boutonSubmit" type="submit" value="Ajouter au panier" class="btn btn-info" />
        </form>

<?php

        //edit book, permet la recuperation et l'envoie des données sur checkBook puis manageBook
        $formEdit =  new form('formEdit','formEdit','post','checkBook.php', 'inline');
        $formEdit->hidden('','id','id','','hidden','',$j->id,'');
        $formEdit->hidden('','auth','auth','','hidden','', $auth,'' );
        ///////////////////////
        $formEdit->hidden('','img','img','','hidden','', $j->img, '');
        $formEdit->hidden('','label','label','','hidden','', $j->label, '');
        $formEdit->hidden('','price','price','','hidden','', $j->price, '');
        $formEdit->hidden('','quantity','quantity','','hidden','', $j->stock, '');
        $formEdit->hidden('','buttonActif','buttonActif','','hidden','',$j->actif,'');

        /////////////////////
        $formEdit->setSubmit('edit', 'Modifier un livre', '', 'btn btn-info');
        echo $formEdit->getForm();

        echo "</div><td >" ;
        //echo " id du livre : ".$idLivre;

        if($j->actif == 0){
            echo " Inactif ";
        }else{
            echo " Actif ";
        }

        echo "<form method='post'>        
          <input type='hidden' name='label' id ='idBook" . $j->id . "' value='" . $j->id .  /* pour savoir quel livre désactiver */
            "' >
				<input type='checkbox' name='checkBoxActif' id='checkBoxActif" .$j->id ."'";

        // On vérifie en DB que l'utilisateur est actif, pour checké par défault la checkbox ou non.
        if ($j->actif == 1) {
            echo "checked='checked'";
        }
        echo "
                    /><label >";
        if ($j->actif == 1) {
            echo " Désactiver ";
        }
        else
        {
            echo " Activer ";
        }


        echo " </td>
                 </label>
                
                 </p>
		
		</form>";



        echo "</tr>";

    }

    '</tbody>
                 </table>';
}
else{
    echo "Le livre n'existe pas";
}



?>