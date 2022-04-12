<?php

declare(strict_types=1);

namespace Edeans\Application\ListTerms;

interface TermsListRepository
{
    public function list(): TermsList;
}
