<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Common;

use Webmozart\Assert\Assert;

trait AggregateName
{
    private string $name;

    private function __construct(string $name)
    {
        Assert::stringNotEmpty($name);

        $this->name = $name;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }
}
