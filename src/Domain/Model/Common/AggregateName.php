<?php

declare(strict_types=1);

namespace Domain\Model\Common;

trait AggregateName
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }
}
