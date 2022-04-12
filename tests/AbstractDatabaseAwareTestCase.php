<?php

declare(strict_types=1);

namespace Edeans\Tests;

use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\ORMException;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

abstract class AbstractDatabaseAwareTestCase extends TestCase
{
    private EntityManager $entityManager;

    /**
     * @throws ORMException
     * @throws DBALException
     */
    protected function setUp(): void
    {
        $container = new TestServiceContainer();
        $this->entityManager = $container->entityManager();

        $this->clearStorage();
    }

    /**
     * @throws DBALException
     */
    private function clearStorage(): void
    {
        if (!$metadata = $this->entityManager->getMetadataFactory()->getAllMetadata()) {
            return;
        }

        $tableNames = array_map(
            fn(ClassMetadata $classMetadata): string => $classMetadata->getTableName(),
            array_filter(
                $metadata,
                fn(ClassMetadata $classMetadata): bool => !$classMetadata->isEmbeddedClass
            )
        );

        $conn = $this->entityManager->getConnection();
        foreach ($tableNames as $tableName) {
            $conn->executeStatement(
                $conn->getDatabasePlatform()->getTruncateTableSQL($tableName)
            );
        }
    }
}
