<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

use LogicException;

final class CouldNotCloseTerm extends LogicException
{
    public static function becauseIsAlreadyClosed(): self
    {
        return new self('The term is already closed.');
    }
}
