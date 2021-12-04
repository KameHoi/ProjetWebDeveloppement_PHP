<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
$titre = 'Ajouter un nouvel utilisateur';

require_once('core.php');
require_once('../VIEW/header.php');
require_once ('typeCount.php');

require_once('../VIEW/ajoutUser.php');
require_once('../VIEW/footer.php');

?>
<script type="text/javascript" src="../VIEW/JS/listenerAjoutUser.js"></script>
<!-- Custom styles for this template -->

