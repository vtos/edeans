<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

final class VisibilityStatus
{
    private const VISIBLE = 'visible';

    private const HIDDEN = 'hidden';

    private string $status;

    private function __construct(string $status)
    {
        $this->status = $status;
    }

    public function asString(): string
    {
        return $this->status;
    }

    public static function visible(): self
    {
        return new self(self::VISIBLE);
    }

    public static function hidden(): self
    {
        return new self(self::HIDDEN);
    }
}
