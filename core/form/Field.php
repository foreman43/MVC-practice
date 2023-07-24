<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    const VARIANT_CONTROL = 0;
    const VARIANT_CHECK = 1;
    public Model $model;
    public string $attribute;
    public string $type;
    public int $variant;
    public string $value;
    public ?string $label;

    public function __construct(
        Model $model,
        string $attribute,
        string $type = "text",
        int $variant = self::VARIANT_CONTROL,
        string $value = null,
        string $label = null
    ) {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
        $this->variant = $variant;
        $this->value = $value ?? $attribute;
        $this->label = $label;
    }

    public function __toString()
    {
        switch ($this->variant)
        {
            case self::VARIANT_CONTROL:
                return sprintf(
                    '<label class="form-label">%s</label>
                    <input type="%s" name="%s" class="form-control%s" value="%s">
                    <div class="invalid-feedback" style="display: block">%s</div>',
                    $this->model->getLabels()[$this->attribute],
                    $this->type,
                    $this->attribute,
                    $this->model->containErrors($this->attribute) ? ' in-valid' : '',
                    $this->type != 'password'
                        ? $this->model->{$this->attribute} ?? '': '',
                    $this->model->getFirstError($this->attribute)
                );

            case self::VARIANT_CHECK:
                return sprintf(
                    '<div class="form-check">
                    <input class="form-check-input" type="%s" name="%s" value="%s" %s>
                    <label class="form-check-label">%s</label>
                    </div>',
                    $this->type,
                    $this->attribute,
                    $this->value,
                    $this->model->{$this->attribute} ? "checked" : "",
                    $this->label ?? $this->model->getLabels()[$this->value]
                );
        }
    }
}