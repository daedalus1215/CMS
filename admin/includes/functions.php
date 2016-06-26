<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function __autoload($class)
{
    $class = strtolower($class);
    $path = '../includes/{$class}.php';

    if (file_exists($path)) {
        require_once($path);
    } else {
        die('Issue with autoloading: ' . $path);
    }

}