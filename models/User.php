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
    public int $role_id = 3;

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
            'role_id'
        ];
    }

    public function rules(): array
    {
        //todo: finish filling the rules
        return [
            'email' => [
                [self::REQUIRED],
                [self::UNIQUE, 'class' => self::class],
            ],
            'password' => [
                [self::REQUIRED],
                [self::MIN, 'min' => 5],
            ],
            'confirmPassword' => [
                [self::REQUIRED],
            ],
        ];
    }

    public function register()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $this->save();
    }

    public function getLabels(): array
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