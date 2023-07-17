<?php

namespace app\core;
//todo: rewrite db to use app namespace
//use Db\Db;
abstract class Model
{
    public const REQUIRED = 'required';
    public const MIN = 'min';
    public const MAX = 'max';
    public const EMAIL = 'email';
    public const MACH = 'mach';

    //protected $db = null;

    public array $errors = [];

    public function __construct()
    {
        //$this->db = Db::createConnection();
    }

    abstract public function rules(): array;

    public function putData($data): void
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
                            $this->addError($attribute, self::REQUIRED, $rule);
                        }
                        break;
                    case self::EMAIL:
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($attribute, self::MIN, $rule);
                        }
                        break;
                    case self::MIN:
                        if(strlen($value) < $rule['min']) {
                            $this->addError($attribute, self::MIN, $rule);
                        }
                        break;
                    case self::MAX:
                        if(strlen($value) > $rule['max']) {
                            $this->addError($attribute, self::MAX, $rule);
                        }
                        break;
                    case self::MACH:
                        if($value != $rule['mach']) {
                            $this->addError($attribute, self::MACH, $rule);
                        }
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

    public function addError(string $attribute, string $ruleType, $rule = []): void
    {
        $message = $this->getErrorMessage()[$ruleType] ?? '';
        foreach ($rule as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function getErrorMessage(): array
    {
        return [
            self::REQUIRED => "field is required",
            self::MIN => "field must be longer then {min}",
            self::MAX => "field must be shorter then {max}",
            self::EMAIL => "field must be an Email",
            self::MACH => "{attribute} must mach a {mach} field"
        ];
    }
}