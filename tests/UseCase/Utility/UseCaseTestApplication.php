<?php

declare(strict_types=1);

namespace Edeans\Tests\UseCase\Utility;

use Doctrine\Common\Collections\ArrayCollection;
use Edeans\Application\AddTerm\AddTerm;
use Edeans\Application\Application;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Infrastructure\RamseyUuid;

final class UseCaseTestApplication implements Application
{
    private ArrayCollection $termsAdded;

    private ArrayCollection $termsHiddenId;

    public function __construct()
    {
        $this->termsAdded = new ArrayCollection();
        $this->termsHiddenId = new ArrayCollection();
    }

    public function addTerm(AddTerm $addTerm): TermId
    {
        $addedTermId = TermId::fromUuid(new RamseyUuid());

        $termToList = new Term();
        $termToList->name = $addTerm->name;
        $this->termsAdded->set($addedTermId->asString(), $termToList);

        return $addedTermId;
    }

    public function hideTerm(TermId $id): void
    {
        $this->termsHiddenId->add($id->asString());
    }

    public function listTerms(): TermsList
    {
        $termsList = new TermsList();
        $addedTermsAsArray = $this->termsAdded->toArray();
        $termsHiddenId = $this->termsHiddenId;

        array_walk($addedTermsAsArray,
            function (Term $term, string $termId) use ($termsList, $termsHiddenId) {
                if (!$termsHiddenId->contains($termId)) {
                    $termsList->add($term);
                }
            },
        );

        return $termsList;
    }
}
