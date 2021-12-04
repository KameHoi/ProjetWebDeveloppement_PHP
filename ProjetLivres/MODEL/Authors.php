<?php
    class Authors extends Model
    {
        var $table = 'authors';
        var $data;
        var $dataPassword;
        var $id;
        var $PK = "ID";

        function addAuthors($label)
        {
            $req = $this->connexion->prepare('CALL addAuthors(:label)');
            $req->bindParam(':label', $label, PDO::PARAM_STR, 256);
            $req->execute();
        }
    }



?>