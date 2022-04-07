<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\Term\Term;
use Edeans\Domain\Model\Term\TermRepository;

final class TermRepositoryUsingORM implements TermRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     */
    public function store(Term $term): void
    {
        $this->entityManager->persist($term);
        $this->entityManager->flush();
    }

    /**
     * @throws ORMException
     */
    public function remove(Term $term): void
    {
        $this->entityManager->remove($term);
        $this->entityManager->flush();
    }
}
