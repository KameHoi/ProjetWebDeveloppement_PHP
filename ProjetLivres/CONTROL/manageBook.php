<?php
if (session_status() == PHP_SESSION_NONE) {                 // Verifier si la session n'est pas déjà ouverte
    session_start();
}
?>
<section>
    <article>
        <?php

        require('../VIEW/header.php');

        require('../VIEW/Form.php');
        require('../MODEL/Model.php');
        $books = Model::load("books");
        $books->read2();

        $author = Model::load("authors");
        $author->read2();

        require('../VIEW/manageBook.php');

        require('../VIEW/footer.php');


        ?>
    </article>
</section>