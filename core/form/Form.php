<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function formBegin(string $action="", string $method="post")
    {
        echo sprintf('<form action="%s" method="%s">',$action, $method);
    }

    public function formEnd()
    {
        echo "</form>";
    }

    public function field($attribute, $type)
    {
        echo new Field($this->model, $attribute, $type);
    }

    public function submitButton(string $text="Submit")
    {
        echo '<button type="submit" class="btn btn-primary">' . $text . '</button>';
    }
}