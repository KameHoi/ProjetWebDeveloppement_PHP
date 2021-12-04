<?php
function debug($variable){
    echo '<pre>'. print_r($variable, true).'</pre>';
}

function nameForm($variable){
    $variable ++;
    return $variable;
}

