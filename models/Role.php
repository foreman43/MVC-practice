<?php

namespace app\models;

use app\core\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName(): string
    {
        return "role";
    }

    public function attributes(): array
    {
        return [
            "id",
            "name"
        ];
    }

    public static function primaryKey(): string
    {
        return "id";
    }

    public function rules(): array
    {
        return [];
    }

    public function getLabels(): array
    {
        return [
            "id" => "Идентификатор",
            "name" => "Имя роли"
        ];
    }
}