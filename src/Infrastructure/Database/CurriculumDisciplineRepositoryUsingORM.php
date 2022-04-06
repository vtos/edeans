<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDiscipline;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineRepository;

final class CurriculumDisciplineRepositoryUsingORM implements CurriculumDisciplineRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     */
    public function store(CurriculumDiscipline $curriculumDiscipline): void
    {
        $this->entityManager->persist($curriculumDiscipline);
        $this->entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(CurriculumDiscipline $curriculumDiscipline): void
    {
        $this->entityManager->remove($curriculumDiscipline);
        $this->entityManager->flush();
    }
}
