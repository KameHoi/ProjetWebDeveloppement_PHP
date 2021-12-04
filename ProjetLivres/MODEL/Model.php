<?php
class Model
{
    protected $table = '';
    protected $connexion;
    public $id;

    public $lastInserted;
    /* C'est pour les requetes
    public $dump_sql;
    */

    /**
     * Connexion à la DB
     * Model constructor.
     */
    public function __construct()
    {
        try
        {

            $dns = 'mysql:host=localhost;dbname=projetlivres';
            $user = "root";
            $pass = "";


            // Options de connection
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8"
            );

            // Initialisation de la connexion
            $this->connexion = new PDO ($dns, $user, $pass, $options);

            /* connexions persistantes
             $this->connexion = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
            */

        }
        catch (PDOException $e)
        {
            print "Connexion à MYSQL impossible ! " . $e->getMessage() . "<br/>";
            die();
        }

    }


    /**
     * Fonction read
     * @param null $fields
     * @param string $where
     */
    public function read($fields = null, $where = '')           // fields = champs donc select nom, prenom ...
    {
        /*C'est pour les champs*/

        if ($fields == null) {
            $fields = '*';                                      // Ici c'est pour prendre tous les champs si jamais aucun param n'est entré
        }

        //$sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' where ' .$where;
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' where ' .$where;
        //$select = $this->connexion->prepare('SELECT ? FROM ? where username = ?');
        try
        {
            //$select->execute($fields, $this->table, $where);
            $select = $this->connexion->query($sql);

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
/*
        try
        {
            /*
            $select = $this->connexion->query($sql);

            //On indique que nous utiliserons les résultats en tant qu'objet
            $this->data = $select->fetch(PDO::FETCH_OBJ);
*/
    /*
    $req = $this->connexion->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute(['username' => $_POST['username']]);

     */
    /*
$req = $this->connexion->prepare('SELECT * FROM :table WHERE :username');
$req->execute(['table' => $this->table, 'username' => $where]);
$this->data = $req->fetch();

}
catch ( Exception $e)
        {
            echo 'Une erreur est survenue lors de la récupération des données';
        }
    }

 */

    /**
     * fonction read un peu differente, à cause d'un bug
     * @param null $fields
     * @param string $where
     */

    public function read2($fields = null, $where = '')           // fields = champs donc select nom, prenom ...
    {
        if ($fields == NULL)
        {
            $fields = '*';// Ici c'est pour prendre tous les champs si jamais aucun param n'est entré
        }
        if ($this->id==null)
        {
            $sql = 'SELECT ' .$fields. ' From '.$this->table;     // Pour l'utiliser dans la requete
            if ($where != '')//ici ca merde le fetch des qu'on le parametre
            {
                $sql.=' where '.$where;

            }
        }
        else
        {
            $sql = 'SELECT ' .$fields. ' FROM ' .$this->table . ' where ' .$this->PK. " = '" .$this->id. "'";

        }

        try
        {
            /*
            //on envoie la requête
            if($this->dump_sql==true)
            {
                echo $sql;
            }
            */
            $select = $this->connexion->query($sql);

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
     * execution de n'importe quelle requete
     * @param $sql
     * @return array
     */

    public function query($sql, $data = array()){
        $req = $this->connexion->prepare($sql);
        $req->execute($data);
        $this->lastInserted = $this->connexion->lastInsertId();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * fonction load, pour créer des objets
     * @param $nom
     * @return mixed
     */
    static function load($nom)
    {
        require ('../model/'.$nom.'.php');
        return new $nom();              // Il renvoit le nouvel objet à la place de le faire de l'autre côté

    }
}
?>