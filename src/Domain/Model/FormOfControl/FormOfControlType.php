<?php

declare(strict_types=1);

namespace Domain\Model\FormOfControl;

final class FormOfControlType
{
    public const GRADE_TYPE = 'grade';

    public const PASS_TYPE = 'pass';

    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function asString(): string
    {
        return $this->type;
    }

    public static function fromString(string $type): self
    {
        return new self($type);
    }
}
