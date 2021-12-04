<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

$titre = 'Parametres';

require_once('core.php');
require_once('../VIEW/header.php');
require_once ('typeCount.php');


require_once('../VIEW/listUsers.php');

require_once('../VIEW/footer.php');

