<?php

namespace app\core;

use Db\Db;
class Model
{
    protected $db = null;
    public function __construct()
    {
        $this->db = Db::createConnection();
    }
}