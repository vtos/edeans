<?php

declare(strict_types=1);

namespace Domain\Model\FormOfControl;

class FormOfControl
{
    private FormOfControlName $name;

    private FormOfControlType $type;

    public function __construct(FormOfControlName $name, FormOfControlType $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function name(): FormOfControlName
    {
        return $this->name;
    }

    public function rename(FormOfControlName $name): void
    {
        $this->name = $name;
    }

    public function changeType(FormOfControlType $type): void
    {
        $this->type = $type;
    }

    public function isOfGradeType(): bool
    {
        return $this->type->asString() === FormOfControlType::GRADE_TYPE;
    }

    public function isOfPassType(): bool
    {
        return $this->type->asString() === FormOfControlType::PASS_TYPE;
    }
}
