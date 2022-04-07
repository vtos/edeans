<?php

declare(strict_types=1);

namespace Edeans\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineRepository;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Domain\Model\Term\TermRepository;
use Edeans\Infrastructure\Database\AcademicDisciplineRepositoryUsingORM;
use Edeans\Infrastructure\Database\CurriculumDisciplineRepositoryUsingORM;
use Edeans\Infrastructure\Database\FormOfControlRepositoryUsingORM;
use Edeans\Infrastructure\Database\TermRepositoryUsingORM;

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
}
