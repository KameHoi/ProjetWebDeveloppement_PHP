<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

$titre = 'Page 1';

require('../VIEW/headCo.php');
require('typeCount.php');
typeCount();
require('../VIEW/page1.php');
require('../VIEW/footer.php');

