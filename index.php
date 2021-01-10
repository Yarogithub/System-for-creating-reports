<?php

require 'config.php';
//require 'data.php';
require 'entities/Users.php';
require 'entities/ReportEnt.php';
require 'entities/Divisions.php';
require 'entities/Departments.php';
require 'entities/Tasks.php';
require 'entities/Positions.php';
require 'entities/DepartmentsTasks.php';
require 'validators/DivisionValidator.php';
require 'validators/DepartmentValidator.php';
require 'validators/TaskValidator.php';
require 'validators/PositionValidator.php';
require 'validators/UserValidator.php';
require 'validators/ReportValidator.php';
require 'validators/PasswordValidator.php';
require 'validators/EmailValidator.php';
require 'utilities/Auth.php';

require 'libs/Bootstrap.php';
require 'libs/Controllers.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Mailer.php';


//
//// Library
require 'libs/Database.php';
require 'libs/Session.php';
//
//
$bootstrap = new Bootstrap();
$bootstrap->init();



