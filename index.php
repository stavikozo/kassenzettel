<?php
function myAutoloader($className): void
{
    $classFile = "Class/" . $className . '.php';

    if (file_exists($classFile)) {
        require_once $classFile;
    }
}

spl_autoload_register('myAutoloader');

//Kassenzettel::delete(4);
Proctukt::update(10, 'Cola', 2.50, 0.07);
