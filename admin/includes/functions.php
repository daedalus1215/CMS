<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ClassAutoLoader($className)
{

    $className = ucwords($className);       // make sure first letter is capitalized and rest lowercase.
    $path = __DIR__."/{$className}.php";    // current dir with passed in class name

    if (file_exists($path) && !class_exists($path)) {               // make sure the file exists int he correct path.
        require_once($path);
    } else {
        die('Issue with autoloading: ' . $path);
    }
}
// invoke spl_register on the Autoloader above.
spl_autoload_register('classAutoLoader');