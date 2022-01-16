<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Common;

interface UuidProvider
{
    public function uuid(): string;
}
