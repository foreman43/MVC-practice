<?php

namespace app\core;

abstract class ActiveRecord extends Model
{
    abstract static public function tableName(): string;
    abstract public function attributes(): array;

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $values = array_map(fn($attr) => ":$attr", $attributes);
        $statment = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
        VALUES(".implode(',', $values).")");

        foreach ($attributes as $attribute) {
            $statment->bindValue(":$attribute", $this->{$attribute});
        }
        return $statment->execute();
    }

    public static function findOne($stat = []): ActiveRecord
    {
        $tableName = static::tableName();
        $attributes = array_keys($stat);
        $where = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statment = self::prepare("SELECT * FROM $tableName WHERE $where");
        foreach ($stat as $key => $value) {
            $statment->bindValue(":$key", $value);
        }
        $statment->execute();
        return $statment->fetchObject(static::class);
    }

    public static function prepare(string $query)
    {
        return Application::$app->db->prepare($query);
    }
}