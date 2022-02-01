<?php

declare(strict_types=1);

namespace Edeans\Tests\Contract\Infrastructure\Database;

use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControlType;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

final class FormOfControlRepositoryUsingORMTest extends TestCase
{
    private FormOfControlRepository $repository;

    /**
     * @throws ORMException
     */
    protected function setUp(): void
    {
        $this->repository = (new TestServiceContainer())->formOfControlRepository();
    }

    /**
     * @test
     */
    public function it_can_store_form_of_control(): void
    {
        $this->repository->store(
            new FormOfControl(
                FormOfControlId::fromUuid(

                ),
                FormOfControlName::fromString('Exam'),
                FormOfControlType::fromString(FormOfControlType::GRADE_TYPE)
            )
        );
    }
}
