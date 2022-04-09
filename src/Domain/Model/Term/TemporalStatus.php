<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

final class TemporalStatus
{
    private const ELAPSED = 'elapsed';

    private const CURRENT = 'current';

    private const UPCOMING = 'upcoming';

    private string $status;

    private function __construct(string $status)
    {
        $this->status = $status;
    }

    public static function elapsed(): self
    {
        return new self(self::ELAPSED);
    }

    public static function current(): self
    {
        return new self(self::CURRENT);
    }

    public static function upcoming(): self
    {
        return new self(self::UPCOMING);
    }
}
