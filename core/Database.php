<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $userName = $config['userName'] ?? '';
        $userPassword = $config['userPassword'] ?? '';
        $this->pdo = new \PDO($dsn, $userName, $userPassword);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare(string $query)
    {
        return $this->pdo->prepare($query);
    }
}