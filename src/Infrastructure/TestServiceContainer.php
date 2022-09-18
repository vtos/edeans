<?php

declare(strict_types=1);

namespace Edeans\Infrastructure;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Edeans\Application\Application;
use Edeans\Application\ListTerms\TermsListRepository;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineRepository;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Domain\Model\Term\TermRepository;
use Edeans\Infrastructure\Database\AcademicDisciplineRepositoryUsingORM;
use Edeans\Infrastructure\Database\CurriculumDisciplineRepositoryUsingORM;
use Edeans\Infrastructure\Database\FormOfControlRepositoryUsingORM;
use Edeans\Infrastructure\Database\TermsListRepositoryUsingDbal;
use Edeans\Infrastructure\Database\TermRepositoryUsingORM;
use Edeans\Tests\UseCase\Utility\UseCaseTestApplication;
use Laminas\Hydrator\ObjectPropertyHydrator;

final class TestServiceContainer
{
    private ?EntityManager $entityManager = null;

    private ?Connection $connection = null;

    public function application(): Application
    {
        return new UseCaseTestApplication(new RamseyUuid());
    }

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

    /**
     * @throws ORMException
     */
    public function academicDisciplineRepository(): AcademicDisciplineRepository
    {
        return new AcademicDisciplineRepositoryUsingORM($this->entityManager());
    }

    /**
     * @throws ORMException
     */
    public function termRepository(): TermRepository
    {
        return new TermRepositoryUsingORM($this->entityManager());
    }

    /**
     * @throws ORMException
     */
    public function curriculumDisciplineRepository(): CurriculumDisciplineRepository
    {
        return new CurriculumDisciplineRepositoryUsingORM($this->entityManager());
    }

    /**
     * @throws DBALException
     */
    public function termsListRepository(): TermsListRepository
    {
        return new TermsListRepositoryUsingDbal($this->connection(), new ObjectPropertyHydrator());
    }

    /**
     * @throws DBALException
     */
    private function connection(): Connection
    {
        return null !== $this->connection
            ? $this->connection
            : DriverManager::getConnection([
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/../../var/sqlite/edeans_test.db',
            ]);
    }
}
