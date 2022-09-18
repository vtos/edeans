<?php

declare(strict_types=1);

namespace Edeans\Tests\UseCase\Utility;

use Edeans\Application\AddTerm\AddTerm;
use Edeans\Application\Application;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Common\UuidProvider;
use Edeans\Domain\Model\Term\TermId;

final class UseCaseTestApplication implements Application
{
    private UuidProvider $uuidProvider;

    private array $termsAddedArray;

    private array $hiddenTermsIdArray;

    public function __construct(UuidProvider $uuidProvider)
    {
        $this->uuidProvider = $uuidProvider;

        $this->termsAddedArray = [];
        $this->hiddenTermsIdArray = [];
    }

    public function addTerm(AddTerm $addTerm): TermId
    {
        $addedTermId = TermId::fromUuid($this->uuidProvider);

        $termToList = new Term();
        $termToList->name = $addTerm->name;
        $this->termsAddedArray[$addedTermId->asString()] = $termToList;

        return $addedTermId;
    }

    public function hideTerm(TermId $id): void
    {
        $this->hiddenTermsIdArray[] = $id->asString();
    }

    public function listTerms(): TermsList
    {
        $termsList = new TermsList();
        $hiddenTermsIdArray = $this->hiddenTermsIdArray;

        array_walk($this->termsAddedArray,
            function (Term $term, string $termId) use ($termsList, $hiddenTermsIdArray) {
                if (!in_array($termId, $hiddenTermsIdArray)) {
                    $termsList->add($term);
                }
            }
        );

        return $termsList;
    }
}
