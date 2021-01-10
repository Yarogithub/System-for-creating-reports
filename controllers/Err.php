<?php


class Err extends Controllers
{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $this->view->render('error/index');
    }
}