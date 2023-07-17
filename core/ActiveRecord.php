<?php

namespace app\core;

abstract class ActiveRecord extends Model
{
    abstract public function tableName(): string;
    abstract  public function attributes(): array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $values = array_map(fn($attr) => ":$attr", $attributes);
        $statment = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
        VALUES(".implode(',', $values).")");

        foreach ($attributes as $attribute) {
            $statment->bindValue(":$attribute", $this->{$attribute});
        }
        $statment->execute();
    }

    public static function prepare(string $query)
    {
        return Application::$app->db->pdo->prepare($query);
    }
}