<?php

function connection_autoloader($class) {
    $class = str_replace('\\', '/', $class);  
    include __DIR__.'/../' . $class . '.php';
}

spl_autoload_register('connection_autoloader');

?>
