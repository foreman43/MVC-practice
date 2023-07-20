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
    public string $value;
    public int $variant;

    public function __construct(
        Model $model,
        string $attribute,
        string $type = "text",
        int $variant = self::VARIANT_CONTROL,
        string $value = null,
    ) {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
        $this->value = $value ?? $attribute;
        $this->variant = $variant;
    }

    public function __toString()
    {
        //todo: Fix bug: errors not shown to user(exist in DOM struct)

        switch ($this->variant)
        {
            case self::VARIANT_CONTROL:
                return sprintf(
                    '<label class="form-label">%s</label>
                    <input type="%s" name="%s" class="form-control%s" value="%s">
                    <div class="invalid-feedback">%s</div>',
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
                    <input class="form-check-input" type="%s" name="%s" value="%s">
                    <label class="form-check-label">%s</label>
                    </div>',
                    $this->type,
                    $this->attribute,
                    $this->value,
                    $this->model->getLabels()[$this->value]
                );
        }
    }
}