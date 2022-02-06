<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;

final class FormOfControlRepositoryUsingORM implements FormOfControlRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function getOneById(FormOfControlId $id): FormOfControl
    {
        return $this->entityManager->find(FormOfControl::class, $id);
    }

    /**
     * @throws ORMException
     */
    public function store(FormOfControl $formOfControl): void
    {
        $this->entityManager->persist($formOfControl);
        $this->entityManager->flush();
    }

    /**
     * @throws ORMException
     */
    public function remove(FormOfControl $formOfControl): void
    {
        $this->entityManager->remove($formOfControl);
        $this->entityManager->flush();
    }
}
