<?php

namespace app\core;

class Database
{
    public \PDO $pdo;
    public string $dsn;
    public string $userName;
    public string $userPassword;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $userName = $config['userName'] ?? '';
        $userPassword = $config['userPassword'] ?? '';
        $this->pdo = new \PDO($dsn, $userName, $userPassword);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}