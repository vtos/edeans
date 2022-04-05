<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\Term;

class Term
{
    private TermId $id;

    private TermName $name;

    public function __construct(TermId $id, TermName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
