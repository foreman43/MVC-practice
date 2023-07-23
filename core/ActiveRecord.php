<?php

namespace app\core;

abstract class ActiveRecord extends Model
{
    abstract static public function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;

    public function save(): bool
    {
        var_dump($this);
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

    public static function find(
        array|string $attributes = "*",
        string $where = null
    ): array
    {
        $where = $where ?? static::primaryKey() . "=" . static::primaryKey();
        $tableName = static::tableName();
        $attributes = is_array($attributes) ? implode(", ", $attributes) : $attributes;
        $statment = self::prepare("SELECT $attributes FROM $tableName WHERE $where");
        $statment->execute();

        $queryResult = [];
        while ($record = $statment->fetchObject(static::class)) {
            array_push($queryResult, $record);
        }

        return $queryResult;
    }

    public static function prepare(string $query)
    {
        return Application::$app->db->prepare($query);
    }

    abstract public function getLabels(): array;
}