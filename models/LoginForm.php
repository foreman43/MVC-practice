<?php

namespace app\models;

use app\core\Model;

class LoginForm extends Model
{
    public string $email;
    public string $password;
    public function rules(): array
    {
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

    public function getLabels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}