<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute, string $type="text")
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString()
    {
        //todo: Fix bug: errors not shown to user(exist in DOM struct)
        return sprintf(
            '<label class="form-label">%s</label>
            <input type="%s" name="%s" class="form-control%s" value="%s">
            <div class="invalid-feedback">%s</div>',
            $this->model->getLabel()[$this->attribute],
            $this->type,
            $this->attribute,
            $this->model->containErrors($this->attribute) ? ' in-valid' : '',
            $this->type != 'password'
                ? $this->model->{$this->attribute} ?? '': '',
            $this->model->getFirstError($this->attribute)
        );
    }
}