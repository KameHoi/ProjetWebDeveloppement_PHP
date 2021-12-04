<?php
class Users extends Model
{
    var $table = 'users';
    var $data;
    var $dataPassword;
    var $id;
    var $PK = "ID";
    var $username;       // pour le where, pour comparer avec username qui est enregistré dans la DB
    var $verif = 'false';
    var $user;

    /**
     * Fonction d'ajout d'utilisateur en faisant appel à une SP
     * @param $username
     * @param $password
     * @param $name
     * @param $surname
     */
    function addUser($username,$password,$name,$surname,$actif = 1, $idRole = 2)
    {
        //echo 'ICI 1 ';
        $req = $this->connexion->prepare('CALL addUser(:username,:password,:name,:surname,:actif,:idRole)');
        $req->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $req->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $req->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $req->bindParam(':surname', $surname, PDO::PARAM_STR, 100);
        $req->bindParam(':actif', $actif, PDO::PARAM_STR, 1);
        $req->bindParam(':idRole', $idRole, PDO::PARAM_STR, 11);
        $req->execute();
        //echo 'ICI 2';
    }


    /**
     * Fonction de lecture des passwords
     * readPassword
     */
    public function readPassword()           // fields = champs donc select nom, prenom ...
    {

        try
        {

            $req = $this->connexion->prepare('SELECT * FROM users WHERE username = :username');
            $req->execute(['username' => $this->username]);
            $this->data = $req->fetch();

        }
        catch ( Exception $e)
        {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }

    /**
     * Methode d'update de mot de passe
     * @param $password
     */

    public function updatePassword($password)
    {


        try
        {

            $req = $this->connexion->prepare('UPDATE users SET password = :password where username = :username');
            $req->execute(['password' => $password, 'username' => $this->username]);
            $this->data = $req->fetch();

        }
        catch ( Exception $e)
        {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }

    /**
     * Fonction update d'utilisateurs
     * @param $name
     * @param $surname
     * @param $password
     */
    public function updateUser($name, $surname, $password)
    {


        try
        {

            $req = $this->connexion->prepare('UPDATE users SET name = :name, surname = :surname, password = :password where username = :username');
            $req->execute(['name' => $name, 'surname' => $surname, 'password' => $password, 'username' => $this->username]);
            $this->data = $req->fetch();

        }
        catch ( Exception $e)
        {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }

    /**
     * Méthode d'update de statut : actif ou inactif
     * @param $actif
     * @param $username
     */
    public function updateActif($actif, $username)           // fields = champs donc select nom, prenom ...
    {


        try
        {

            $req = $this->connexion->prepare('UPDATE users SET actif = :actif where username = :username');
            $req->execute(['actif' => $actif, 'username' => $username]);
            $this->data = $req->fetch();

        }
        catch ( Exception $e)
        {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }


    /**
     * Selection des utilisateurs
     * @param null $fields
     * @param string $where
     */

    public function selectUsers($fields = null, $where = '')           // fields = champs donc select nom, prenom ...
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
            $username = $_POST['username'].'%';
            $select = $this->connexion->prepare('SELECT * FROM users  JOIN roles on roles.id = users.idRole WHERE username LIKE :username');
            //$select = $this->connexion->prepare('SELECT * FROM users WHERE username LIKE :username');
            $select->execute(['username' => $username]);


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

    /**
     * Fonction pour connaitre le type de compte.
     * @param null $fields
     * @param string $where
     */
    public function typeCount($fields = null, $where = '')           // fields = champs donc select nom, prenom ...
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
            $username = $_POST['username'].'%';
            $select = $this->connexion->prepare('SELECT * FROM users WHERE username LIKE :username');
            $select->execute(['username' => $username]);


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