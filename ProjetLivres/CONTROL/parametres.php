<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}

$titre = 'Parametres';

require_once('../VIEW/header.php');

// On appele typeCount


require_once ('typeCount.php');
require_once('../VIEW/parametres.php');
require_once('../VIEW/footer.php');

?>
<script type="text/javascript" src="../VIEW/JS/listenerParametres.js"></script>
<!-- Custom styles for this template -->


