<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Common;

use Webmozart\Assert\Assert;

trait AggregateId
{
    private string $uuid;

    private function __construct(string $uuid)
    {
        Assert::uuid($uuid);

        $this->uuid = $uuid;
    }

    public function asString(): string
    {
        return $this->uuid;
    }

    public static function fromUuid(UuidProvider $provider): self
    {
        return new self(
            $provider->uuid()
        );
    }
}
