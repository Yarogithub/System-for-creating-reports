<?php


class Index extends Controllers
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->render('index/index');
    }
}