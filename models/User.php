<?php

namespace app\models;

use app\core\ActiveRecord;
use app\core\Model;

class User extends ActiveRecord
{
    public string $email;
    public string $password;
    public string $confirmPassword;

    public function tableName(): string
    {
        return "users";
    }

    public function rules(): array
    {
        //todo: finish filling the rules
        return [
            'email' => [[self::REQUIRED]],
            'password' => [[self::REQUIRED], [self::MIN, 'min' => 5]],
            'confirmPassword' => [[self::REQUIRED]]
        ];
    }

    public function register(): bool
    {
        //todo: finish the function
        return true;
    }

    public function getLabel(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Password Confirm'
        ];
    }
}