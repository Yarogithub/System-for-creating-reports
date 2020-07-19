<?php


class View
{
    /**
     * @var string
     */
    public $title;
    public $userList;
    public $user;
    public $reportsEmployeeList;
    public $reportsAdminList;

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        if ($noInclude == true) {
            require 'views/' . $name . '.php';
        }
        else {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }
}