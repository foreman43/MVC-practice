<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $email;
    public string $password;
    public string $confirmPassword;

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
}