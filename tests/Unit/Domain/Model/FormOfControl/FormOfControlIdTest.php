<?php

declare(strict_types=1);

namespace Edeans\Tests\Unit\Domain\Model\FormOfControl;

use Edeans\Domain\Model\Common\UuidProvider;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class FormOfControlIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_when_instantiated_with_a_non_uuid_value(): void
    {
        $uuidProvider = $this->createMock(UuidProvider::class);
        $uuidProvider->method('uuid')->willReturn('non-uuid-value');

        $this->expectException(InvalidArgumentException::class);
        FormOfControlId::fromUuid($uuidProvider);
    }
}
