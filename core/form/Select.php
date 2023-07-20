<?php

namespace app\core\form;

use app\core\Model;

class Select
{
    public Model $model;
    public string $attribute;
    public array $options;
    public function __construct(Model $model, string $attribute, $options = [])
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    public function __toString(): string
    {
        $select = "<label class=\"form-label\">{$this->model->getLabels()[$this->attribute]}</label><select class=\"form-select\">";

        foreach ($this->options as $key => $value) {
            $select .= "<option value=\"$key\">$value</option>";
        }
        return $select . "</select>";
    }
}