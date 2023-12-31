<?php

namespace app\core;

abstract class Model
{
    public const REQUIRED = "required";
    public const MIN = "min";
    public const MAX = "max";
    public const EMAIL = "email";
    public const MACH = "mach";
    public const UNIQUE = "unique";

    public array $errors = [];

    abstract public function rules(): array;

    public function putData(array $data): void
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleType = $rule;
                if(is_array($rule))
                {
                    $ruleType = $rule[0];
                }

                switch ($ruleType) {
                    case self::REQUIRED:
                        if(!$value) {
                            $this->addErrorByRule($attribute, self::REQUIRED, $rule);
                        }
                        break;

                    case self::EMAIL:
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addErrorByRule($attribute, self::MIN, $rule);
                        }
                        break;

                    case self::MIN:
                        if(strlen($value) < $rule["min"]) {
                            $this->addErrorByRule($attribute, self::MIN, $rule);
                        }
                        break;

                    case self::MAX:
                        if(strlen($value) > $rule["max"]) {
                            $this->addErrorByRule($attribute, self::MAX, $rule);
                        }
                        break;

                    case self::MACH:
                        if($value != $rule["mach"]) {
                            $this->addErrorByRule($attribute, self::MACH, $rule);
                        }
                        break;

                    case self::UNIQUE:
                        $className = $rule["class"];
                        $tableName = $className::tableName();
                        $statment = Application::$app->db->prepare(
                            "SELECT * FROM $tableName 
                            WHERE $attribute = :$attribute"
                        );
                        $statment->bindValue(":$attribute", $value);
                        $statment->execute();
                        $record = $statment->fetchObject();
                        if($record) {
                            $this->addErrorByRule($attribute, self::UNIQUE, $rule);
                        }
                        break;
                }
            }
        }
        return empty($this->errors);
    }

    public function containErrors(string $attribute): bool
    {
        return isset($this->errors[$attribute]) ?? false;
    }

    public function getFirstError(string $attribute): string
    {
        return $this->errors[$attribute][0] ?? '';
    }

    private function addErrorByRule(string $attribute, string $ruleType, $rule = []): void
    {
        $message = $this->getErrorMessage()[$ruleType] ?? '';
        foreach ($rule as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addErrorMessage(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = $message;
    }

    public function getErrorMessage(): array
    {
        return [
            self::REQUIRED => "это поле обязательно",
            self::MIN => "минимальное количество символов: {min}",
            self::MAX => "максимальное количество символов: {max}",
            self::EMAIL => "введите Email",
            self::MACH => "не совпадает с {mach}",
            self::UNIQUE => "уже существует"
        ];
    }
}