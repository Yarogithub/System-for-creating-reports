<?php


class Model
{
    /**
     * @var Database
     */
    public $db;

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

}