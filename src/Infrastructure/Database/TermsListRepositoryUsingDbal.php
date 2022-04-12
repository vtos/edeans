<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception as DBALException;
use Edeans\Application\ListTerms\Term;
use Edeans\Application\ListTerms\TermsListRepository;
use Edeans\Application\ListTerms\TermsList;
use Edeans\Domain\Model\Term\VisibilityStatus;
use Laminas\Hydrator\ObjectPropertyHydrator;

final class TermsListRepositoryUsingDbal implements TermsListRepository
{
    private Connection $connection;

    private ObjectPropertyHydrator $hydrator;

    public function __construct(Connection $connection, ObjectPropertyHydrator $hydrator)
    {
        $this->connection = $connection;
        $this->hydrator = $hydrator;
    }

    /**
     * @throws DBALException
     */
    public function list(): TermsList
    {
        $resultSet = $this->connection->executeQuery(
            'SELECT name FROM term WHERE visibility_status = ?', [
                VisibilityStatus::visible()->asString()
            ]
        );

        $termsList = new TermsList();
        foreach ($resultSet->fetchAllAssociative() as $termAsAssoc) {
            $termsList->add($this->hydrator->hydrate($termAsAssoc, new Term()));
        }

        return $termsList;
    }
}
