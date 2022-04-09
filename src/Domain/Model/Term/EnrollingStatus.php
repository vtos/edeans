<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

final class EnrollingStatus
{
    private const OPEN = 'open';

    private const CLOSED = 'closed';

    private string $status;

    private function __construct(string $status)
    {
        $this->status = $status;
    }

    public static function open(): self
    {
        return new self(self::OPEN);
    }

    public static function closed(): self
    {
        return new self(self::CLOSED);
    }
}
