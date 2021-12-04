<?php
class Orders extends Model
{
    var $table = 'orders';
    var $data;
    var $id;
    var $PK = "ID";
    var $username;       // pour le where, pour comparer avec username qui est enregistré dans la DB
    var $verif = 'false';
    var $user;
    /**
     * Appel à une sp
     * @param $username
     * @param $password
     * @param $name
     * @param $surname
     */
    function addOrders($label, $date_create, $idUser)
    {
        //echo 'ICI 1 ';
        $req = $this->connexion->prepare('CALL addOrders(:label,:date_create,:idUser)');
        $req->bindParam(':label', $label, PDO::PARAM_STR, 256);
        $req->bindValue(':date_create', date('Y-m-d'),PDO::PARAM_STR);
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR, 11);
        $req->execute();
        echo 'ICI 2';
    }

    /**
     *
     * @param null $fields
     * @param string $where
     */
    public function readOrders($fields = null, $where = '')           // fields = champs donc select nom, prenom ...
    {
        /* Mettre les variables du POST en $ */
        /*
                $this->username = $_POST['username'];
            // Pour hash
                $this->password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $this->mail = $_POST['mail'];
        */
        /*C'est pour les champs*/

        if ($fields == null) {
            $fields = '*';                                      // Ici c'est pour prendre tous les champs si jamais aucun param n'est entré
        }

        // Vérification dans DB
        //$sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' where ' . $this->staticUserName . " = '" . $_POST['username'] . "'";
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' where ' .$where;
        //$select = $this->connexion->prepare('SELECT ? FROM ? where username = ?');
        try
        {

            $select = $this->connexion->prepare('
            SELECT *
            FROM users as u
            JOIN orders as o ON o.idUser = u.id

            JOIN orderdetails as od ON od.idOrder = o.id
            JOIN books as b ON b.id = od.idBook');
            //$select = $this->connexion->prepare('SELECT * FROM users WHERE username LIKE :username');
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


}

