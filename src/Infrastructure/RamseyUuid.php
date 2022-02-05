<?php

declare(strict_types=1);

namespace Edeans\Infrastructure;

use Edeans\Domain\Model\Common\UuidProvider;
use Ramsey\Uuid\Uuid;

final class RamseyUuid implements UuidProvider
{
    public function uuid(): string
    {
        return Uuid::uuid4()->toString();
    }
}
