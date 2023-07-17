<?php

namespace models;

use app\core\Model;

class LoginModel extends Model
{
    public string $email;
    public string $password;
    public function rules(): array
    {
        // TODO: Finish implementing rules() method.
        return [
            'email' => [
                [self::REQUIRED],
                [self::EMAIL]
            ],
            'password' => [
                [self::REQUIRED],
                [self::MIN, 'min' => 5],
                [self::MAX, 'max' => 30]
            ]
        ];
    }

    public function login()
    {

    }
}