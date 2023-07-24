<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email;
    public string $password;

    public function rules(): array
    {
        return [
            "email" => [
                [self::REQUIRED],
                [self::EMAIL]
            ],
            "password" => [
                [self::REQUIRED],
                [self::MIN, "min" => 5],
                [self::MAX, "max" => 30]
            ]
        ];
    }

    public function login(): bool
    {
        $user = User::findOne(["email" => $this->email]);
        if(!$user) {
            $this->addErrorMessage("email", "This user does not exist");
            return false;
        }

        if(!password_verify($this->password, $user->password)) {
            $this->addErrorMessage("password", "Wrong email or password");
            return false;
        }

        return Application::$app->login($user);
    }

    public function getLabels(): array
    {
        return [
            "email" => "Email",
            "password" => "Password",
        ];
    }
}