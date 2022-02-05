<?php

declare(strict_types=1);

namespace Edeans\Tests\Contract\Infrastructure;

use Edeans\Infrastructure\RamseyUuid;
use PHPUnit\Framework\TestCase;

final class RamseyUuidTest extends TestCase
{
    /**
     * @test
     */
    public function it_provides_a_string_in_uuid_format(): void
    {
        $this->assertMatchesRegularExpression(
            '/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i',
            (new RamseyUuid())->uuid()
        );
    }
}
