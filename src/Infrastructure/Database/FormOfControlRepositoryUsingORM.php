<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;

final class FormOfControlRepositoryUsingORM implements FormOfControlRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOneById(FormOfControlId $id): FormOfControl
    {
        // TODO: Implement getOneById() method.
    }

    public function findByName(FormOfControlName $name): ?FormOfControl
    {
        // TODO: Implement findByName() method.
    }

    /**
     * @throws ORMException
     */
    public function store(FormOfControl $formOfControl): void
    {
        $this->entityManager->persist($formOfControl);
        $this->entityManager->flush();
    }

    public function remove(FormOfControl $formOfControl): void
    {
        // TODO: Implement remove() method.
    }
}
