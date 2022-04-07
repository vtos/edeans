<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDiscipline;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineRepository;

final class AcademicDisciplineRepositoryUsingORM implements AcademicDisciplineRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     */
    public function store(AcademicDiscipline $discipline): void
    {
        $this->entityManager->persist($discipline);
        $this->entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(AcademicDiscipline $discipline): void
    {
        $this->entityManager->remove($discipline);
        $this->entityManager->flush();
    }
}
