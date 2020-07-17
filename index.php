<?php

require 'config.php';
require 'entities/Users.php';
require 'utilities/Auth.php';
//require 'util/Auth.php';
//
////// Also spl_autoload_register (Take a look at it if you like)
////function spl_autoload_register($class) {
////	require LIBS . $class .".php";
////}
//
//
////Use an autoloader!
require 'libs/Bootstrap.php';
require 'libs/Controllers.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Hash.php';
//
//// Library
require 'libs/Database.php';
require 'libs/Session.php';

//
//
$bootstrap = new Bootstrap();
$bootstrap->init();