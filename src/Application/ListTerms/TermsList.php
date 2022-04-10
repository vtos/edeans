<?php

declare(strict_types=1);

namespace Edeans\Application\ListTerms;

use ArrayIterator;
use IteratorAggregate;

final class TermsList implements IteratorAggregate
{
    private array $items = [];

    public function add(Term $item): void
    {
        $this->items[] = $item;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
