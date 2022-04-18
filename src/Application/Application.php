<?php

declare(strict_types=1);

namespace Edeans\Application;

use Edeans\Application\AddTerm\AddTerm;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Term\TermId;

interface Application
{
    public function addTerm(AddTerm $addTerm): TermId;

    public function hideTerm(TermId $id): void;

    public function listTerms(): TermsList;
}
