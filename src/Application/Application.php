<?php

declare(strict_types=1);

namespace Edeans\Application;

use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Term\TermId;

interface Application
{
    public function addTerm(): TermId;

    public function hideTerm(): void;

    public function listTerms(): TermsList;
}
