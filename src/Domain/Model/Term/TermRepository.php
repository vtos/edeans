<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

interface TermRepository
{
    public function store(Term $term): void;

    public function remove(Term $term): void;
}
