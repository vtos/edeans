<?php

declare(strict_types=1);

namespace Edeans\Tests\UseCase;

use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\ORMException;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Application\ListTerms\TermsListRepository;
use Edeans\Domain\Model\Term\Term as TermEntity;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Domain\Model\Term\TermRepository;
use Edeans\Infrastructure\RamseyUuid;
use Edeans\Infrastructure\TestServiceContainer;
use Edeans\Tests\AbstractDatabaseAwareTestCase;

final class ListTermsTest extends AbstractDatabaseAwareTestCase
{
    private TermRepository $termRepository;

    private TermsListRepository $termsListRepository;

    private RamseyUuid $uuidGenerator;

    /**
     * @test
     */
    public function a_hidden_term_does_not_appear_in_the_list(): void
    {
        $this->termRepository->store(
            TermEntity::withDefaultStatus(TermId::fromUuid($this->uuidGenerator), TermName::fromString('Term 1'))
        );

        $termToHide = TermEntity::withDefaultStatus(
            TermId::fromUuid($this->uuidGenerator),
            TermName::fromString('Term 2')
        );
        $this->termRepository->store($termToHide);

        $expectedTermsList = new TermsList();
        $term = new Term();
        $term->name = 'Term 1';
        $expectedTermsList->add($term);
        $term = new Term();
        $term->name = 'Term 2';
        $expectedTermsList->add($term);

        $this->assertEquals($expectedTermsList, $this->termsListRepository->list());

        $termToHide->hide();
        $this->termRepository->store($termToHide);

        $expectedTermsList = new TermsList();
        $term = new Term();
        $term->name = 'Term 1';
        $expectedTermsList->add($term);

        $this->assertEquals($expectedTermsList, $this->termsListRepository->list());
    }

    /**
     * @throws ORMException
     * @throws DBALException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $container = new TestServiceContainer();
        $this->termRepository = $container->termRepository();
        $this->termsListRepository = $container->termsListRepository();
        $this->uuidGenerator = new RamseyUuid();
    }
}
