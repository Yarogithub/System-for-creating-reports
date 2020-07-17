<?php


class Index extends Controllers
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        //echo Hash::create('sha256', 'jonathan', HASH_PASSWORD_KEY);
        $this->view->render('index/index');
    }
}