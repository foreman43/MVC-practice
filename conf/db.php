<?php

class MainDb
{
    const ServerName = "localhost";
    const UserName = "root";
    const DataBase = "practicmvc";
    const UPassword = "";

    public static function createConnection(): mysqli_connect
    {
        $conn = new mysqli_connect(self::ServerName, self::UserName, self::UPassword, self::DataBase); //writing a connection to the conn variable

        if (mysqli_connect_errno()) //checking the connection success
        {
            printf("Соединение не удалось: %s\n", mysqli_connect_error());
            exit();
        }

        return $conn;
    }
}