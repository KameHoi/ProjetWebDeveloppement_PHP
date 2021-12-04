<?php

unset($_SESSION);
session_start();
session_destroy();          // Suppression de la variable, pour pouvoir recréer un nouvel utilisateur
require_once('page1.php');

?>