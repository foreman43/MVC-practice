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
    public function formBegin(string $action="", string $method="post"): void
    {
        echo sprintf('<form action="%s" method="%s">',$action, $method);
    }

    public function formEnd(): void
    {
        echo "</form>";
    }

    public function field(
        $attribute,
        $type,
        $variant = Field::VARIANT_CONTROL,
        $value = null
    ): void {
        echo new Field($this->model, $attribute, $type, $variant, $value);
    }

    public function label(string $message, string $for = ""): void
    {
        echo "<label class=\"form-label\">$message</label>";
    }

    public function submitButton(string $text="Submit"): void
    {
        echo '<button type="submit" class="btn btn-primary">' . $text . '</button>';
    }
}