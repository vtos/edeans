<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

use LogicException;

final class CouldNotOpenTerm extends LogicException
{
    public static function becauseIsAlreadyOpen(): self
    {
        return new self('The term is already opened.');
    }
}
