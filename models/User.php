<?php

namespace app\models;

use app\core\ActiveRecord;
use app\core\Model;

class User extends ActiveRecord
{
    public string $id = '';
    public string $email = '';
    public string $name = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return [
            'email',
            'name',
            'password',
        ];
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
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $this->save();
    }

    public function getLabel(): array
    {
        return [
            'id' => 'Identifier',
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'confirmPassword' => 'Password Confirm'
        ];
    }
}