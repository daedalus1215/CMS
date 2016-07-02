<?php


(defined('DS')) ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS.'Applications'.DS.'XAMPP');

define('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');


// no idea, but it broke unless I do __DIR__
require_once(__DIR__ . DS . 'config.php');
require_once('Session.php');
require_once('functions.php');
require_once('Database.php');

