<?php

declare(strict_types=1);

namespace Unit\Domain\Model\FormOfControl;

use Domain\Model\FormOfControl\FormOfControlName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class FormOfControlNameTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_to_instantiate_from_an_empty_string(): void
    {
        $this->expectException(InvalidArgumentException::class);
        FormOfControlName::fromString('');
    }
}
