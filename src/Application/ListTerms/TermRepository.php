<?php

declare(strict_types=1);

namespace Edeans\Application\ListTerms;

interface TermRepository
{
    public function list(): TermsList;
}
