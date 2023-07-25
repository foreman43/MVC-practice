<?php

namespace app\core\form;

use app\core\Model;

class Textarea
{
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string
    {
        return sprintf(
            '<div class="mb-3"><label class="form-label">%s</label>
                <textarea class="form-control%s" rows="10" name="%s" >%s</textarea>
                <div class="invalid-feedback" style="display: block">%s</div></div>',
            $this->model->getLabels()[$this->attribute],
            $this->model->containErrors($this->attribute) ? " in-valid" : "",
            $this->attribute,
            $this->model->{$this->attribute} ?? "",
            $this->model->getFirstError($this->attribute)
        );
    }
}