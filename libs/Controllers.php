<?php


class Controllers
{

    /**
     * @var mixed
     */
    public $model;
    /**
     * @var View
     */
    public $view;

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }

    public function loadModel($name) {

        $path = 'models/'.$name.'_model.php';

//        print_r($path);
//        die;

        if (file_exists($path)) {
            require 'models/'.$name.'_model.php';

            $modelName = $name . '_model';
            $this->model = new $modelName();

        }
    }
}