<?php

namespace app\core;

abstract class ActiveRecord extends Model
{
    abstract public function tableName(): string;

    public function save()
    {

    }
}