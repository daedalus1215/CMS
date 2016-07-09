<?php


(defined('DS')) ? null : define('DS', DIRECTORY_SEPARATOR);

//define('SITE_ROOT', 'C:'.DS.'Apache24'.DS.'htdocs'.DS.'1776'.DS.'CMS');  //w
//define('SITE_ROOT', 'C:'.DS.'XAMPP'.DS.'htdocs'.DS.'html'.DS.'CMS'); //h
define('SITE_ROOT', DS.'var'.DS.'www'.DS.'html'.DS.'1776'.DS.'CMS'); //l

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');


// no idea, but it broke unless I do __DIR__
require_once(__DIR__ . DS . 'config.php');
require_once('Session.php');
require_once('functions.php');
require_once('Database.php');
