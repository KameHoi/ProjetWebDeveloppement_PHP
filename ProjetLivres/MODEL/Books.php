<?php

    class Books extends Model
    {
        var $table = 'books';
        var $data;
        var $dataPassword;
        var $id;
        var $PK = "ID";
        var $username;
        var $verif = 'false';
        var $books;

        function addBook($labelBook, $stock, $price, $actif, $idAuthor, $img)
        {


            //le code de la procedure stockée fonctionne, si il y a un procléme, c'est ici

            //de base, un livre est inactif(0) -> il peut juste être en commande ou en attente de déballage
            $req = $this->connexion->prepare('CALL addBook(:label,:stock,:price,:actif,:idAuthor,:img)');

            $req->bindParam(':label', $labelBook, PDO::PARAM_STR, 256);
            $req->bindParam(':stock', $stock, PDO::PARAM_STR, 11);
            $req->bindParam(':price', $price, PDO::PARAM_STR, 10.2);
            $req->bindParam(':actif', $actif, PDO::PARAM_STR, 1);
            $req->bindParam(':idAuthor', $idAuthor, PDO::PARAM_STR, 11);
            $req->bindParam(':img', $img, PDO::PARAM_STR,256);

            $req->execute();

        }


        public function editBook($label, $stock, $price, $idAuthor, $img)           // fields = champs donc select nom, prenom ...
        {
            try {

                $req = $this->connexion->prepare('UPDATE Books SET stock = :stock, price = :price, img = :img where idAuthor = :idAuthor && label = :label');
                $req->execute(['label' => $label, 'stock' => $stock, 'price' => $price,  'idAuthor' => $idAuthor, 'img' => $img]);
                $this->data = $req->fetch();

            } catch (Exception $e) {
                echo 'Une erreur est survenue lors de la récupération des données';
            }
        }


        /**
         * @param null $fields
         * @param string $label
         * @param string $author
         * va afficher les livres selon l'auteur ou le livre choisis par l'utilisateur
         */
        public function selectBooksByLabel($fields = null, $label = '', $author = '')           // fields = champs donc select nom, prenom ...
        {
            if ($fields == null) {
                $fields = '*';                                      // Ici c'est pour prendre tous les champs si jamais aucun param n'est entré
            }
            if($label == null){
                $label = '%';
            }
            if($author == null){
                $author = "%";
            }

            // Vérification dans DB

            $sql = 'SELECT b.* FROM ' . $this->table . ' b join authors on authors.id = b.idAuthor where b.label like  :label and authors.label like :author' ;

            //$select = $this->connexion->prepare('SELECT ? FROM ? where username = ?');
            try
            {
                $select = $this->connexion->prepare($sql);
                $labels = "%".$label."%";
                $select->bindParam('label',$labels, PDO::PARAM_STR, 256);
                $authors = "%".$author."%";
                $select->bindParam('author',$authors,PDO::PARAM_STR,256);
                $select->execute();

                //On indique que nous utiliserons les résultats en tant qu'objet

                $select->setFetchMode(PDO::FETCH_OBJ);
                $this->data = new stdClass();
                $this->data = $select->fetchall();


            }
            catch ( Exception $e)
            {
                echo 'Une erreur est survenue lors de la récupération des données';
            }

        }


        public function updateActif($actif, $id)
        {
            try
            {

                $req = $this->connexion->prepare('UPDATE books SET actif = :actif where  id = :id');
                $req->execute(['actif' => $actif,  'id' => $id]);
                $this->data = $req->fetch();

            }
            catch ( Exception $e)
            {
                echo 'Une erreur est survenue lors de la récupération des données';
            }
        }



    }




?>