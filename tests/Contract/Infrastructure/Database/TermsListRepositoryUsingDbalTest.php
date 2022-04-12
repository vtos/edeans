<?php

declare(strict_types=1);

namespace Edeans\Tests\Contract\Infrastructure\Database;

use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\ORMException;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsListRepository;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Term\Term as TermEntity;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Domain\Model\Term\TermRepository;
use Edeans\Infrastructure\RamseyUuid;
use Edeans\Infrastructure\TestServiceContainer;
use Edeans\Tests\AbstractDatabaseAwareTestCase;

final class TermsListRepositoryUsingDbalTest extends AbstractDatabaseAwareTestCase
{
    private TermsListRepository $termsListRepository;

    private TermRepository $termRepository;

    private RamseyUuid $uuidGenerator;

    /**
     * @test
     */
    public function it_fetches_a_list_of_terms(): void
    {
        $this->termRepository->store(
            TermEntity::withDefaultStatus(TermId::fromUuid($this->uuidGenerator), TermName::fromString('Term 1'))
        );
        $this->termRepository->store(
            TermEntity::withDefaultStatus(TermId::fromUuid($this->uuidGenerator), TermName::fromString('Term 2'))
        );

        $termsList = new TermsList();
        $term = new Term();
        $term->name = 'Term 1';
        $termsList->add($term);
        $term = new Term();
        $term->name = 'Term 2';
        $termsList->add($term);

        $this->assertEquals($termsList, $this->termsListRepository->list());
    }

    /**
     * @throws DBALException
     * @throws ORMException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $container = new TestServiceContainer();
        $this->termsListRepository = $container->termsListRepository();
        $this->termRepository = $container->termRepository();
        $this->uuidGenerator = new RamseyUuid();
    }
}
