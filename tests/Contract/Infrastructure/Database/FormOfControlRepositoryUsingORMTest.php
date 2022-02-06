<?php

declare(strict_types=1);

namespace Edeans\Tests\Contract\Infrastructure\Database;

use Doctrine\DBAL\Exception as DoctrineDBALException;
use Doctrine\DBAL\Schema\Table;
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

    /**
     * @throws ORMException
     * @throws DoctrineDBALException
     */
    protected function setUp(): void
    {
        $container = new TestServiceContainer();
        $this->repository = $container->formOfControlRepository();
        $entityManager = $container->entityManager();

        $conn = $entityManager->getConnection();
        $tables = $conn->createSchemaManager()->listTables();

        array_walk(
            $tables,
            function(Table $table) use($conn) {
                $conn->executeStatement(
                    $conn->getDatabasePlatform()->getTruncateTableSQL($table->getName())
                );
            }
        );
    }

    /**
     * @test
     */
    public function it_can_store_form_of_control(): void
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

        $this->assertEquals($entity, $this->repository->getOneById($id));
    }
}
