<?php

namespace app\core\form;

use app\core\Model;

class TextAreaField extends BaseField
{
    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" value="%s" class="form-control%s"></textarea>',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}