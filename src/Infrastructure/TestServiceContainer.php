<?php

declare(strict_types=1);

namespace Edeans\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Infrastructure\Database\FormOfControlRepositoryUsingORM;

final class TestServiceContainer
{
    private ?EntityManager $entityManager = null;

    /**
     * @throws ORMException
     */
    public function entityManager(): EntityManager
    {
        return null !== $this->entityManager
            ? $this->entityManager
            : $this->entityManager = EntityManager::create(
                ['driver' => 'pdo_sqlite', 'path' => __DIR__ . '/../../var/sqlite/edeans_test.db',],
                Setup::createXMLMetadataConfiguration(
                    [__DIR__ . '/../../config/doctrine/mappings',]
                )
            );
    }

    /**
     * @throws ORMException
     */
    public function formOfControlRepository(): FormOfControlRepository
    {
        return new FormOfControlRepositoryUsingORM($this->entityManager());
    }
}
