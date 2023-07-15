<?php

namespace app\core;
//todo: rewrite db to use app namespace
//use Db\Db;
abstract class Model
{
    public const REQUIRED = 'required';
    public const MIN = 'min';
    public const MAX = 'max';
    public const MACH = 'mach';

    //protected $db = null;

    public array $errors = [];

    public function __construct()
    {
        //$this->db = Db::createConnection();
    }

    abstract public function rules(): array;

    public function putData($data)
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
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
                            $this->addError($attribute, self::REQUIRED);
                        }
                        //todo: add other cases
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $attribute, string $ruleType): void
    {
        $message = $this->getErrorMessage()[$ruleType] ?? '';
        $this->errors[$attribute][] = $message;
    }

    public function getErrorMessage(): array
    {
        return [
            self::REQUIRED => "field {attribute} is required",
            self::MIN => "{attribute} must be longer then {min}",
            self::MAX => "{attribute} must be shorter then {max}",
            self::MACH => "{attribute} must mach a {mach} field"
        ];
    }
}