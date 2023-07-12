<?php

namespace models;
class Model
{
    protected $db = null;
    public function __construct()
    {
        $this->db = \Db::createConnection();
    }
}