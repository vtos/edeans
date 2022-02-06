<?php

declare(strict_types=1);

namespace Edeans\Tests\Contract\Infrastructure\Database;

use Doctrine\DBAL\Exception as DoctrineDBALException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControlType;
use Edeans\Infrastructure\RamseyUuid;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

final class FormOfControlRepositoryUsingORMTest extends TestCase
{
    private FormOfControlRepository $repository;

    private EntityManager $entityManager;

    /**
     * @test
     */
    public function it_can_store_and_remove_a_form_of_control(): void
    {
        $id = FormOfControlId::fromUuid(
            new RamseyUuid()
        );
        $entity = new FormOfControl(
            $id,
            FormOfControlName::fromString('Exam'),
            FormOfControlType::fromString(FormOfControlType::GRADE_TYPE)
        );

        $this->repository->store($entity);
        $this->assertEquals($entity, $storedEntity = $this->repository->getOneById($id));

        // Rename, change type and store it again
        $storedEntity->rename(FormOfControlName::fromString('Passed/Not passed'));
        $storedEntity->changeType(FormOfControlType::fromString(FormOfControlType::PASS_TYPE));
        $this->repository->store($storedEntity);

        $this->assertEquals(
            new FormOfControl(
                $id,
                FormOfControlName::fromString('Passed/Not passed'),
                FormOfControlType::fromString(FormOfControlType::PASS_TYPE)
            ),
            $this->repository->getOneById($id)
        );

        // Now remove it
        $this->repository->remove($storedEntity);
        $this->assertEquals(
            0,
            $this->entityManager->getRepository(FormOfControl::class)->count([])
        );
    }

    /**
     * @throws ORMException
     * @throws DoctrineDBALException
     */
    protected function setUp(): void
    {
        $container = new TestServiceContainer();
        $this->repository = $container->formOfControlRepository();
        $this->entityManager = $container->entityManager();

        $this->clearStorage();
    }

    /**
     * @throws DoctrineDBALException
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
