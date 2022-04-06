<?php

declare(strict_types=1);

namespace Contract\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDiscipline;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineId;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineName;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDiscipline;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineId;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlType;
use Edeans\Domain\Model\Term\Term;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Infrastructure\RamseyUuid;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

final class CurriculumDisciplineRepositoryUsingORMTest extends TestCase
{
    private CurriculumDisciplineRepository $repository;

    private EntityManager $entityManager;

    /**
     * @test
     */
    public function it_stores_and_removes_a_curriculum_discipline(): void
    {
        $id = CurriculumDisciplineId::fromUuid(new RamseyUuid());
        $curriculumDiscipline = new CurriculumDiscipline(
            $id,
            new AcademicDiscipline(
                AcademicDisciplineId::fromUuid(new RamseyUuid()),
                AcademicDisciplineName::fromString('English')
            ),
            new Term(
                TermId::fromUuid(new RamseyUuid()),
                TermName::fromString('Term 1')
            ),
            new FormOfControl(
                FormOfControlId::fromUuid(new RamseyUuid()),
                FormOfControlName::fromString('Passed/Not passed'),
                FormOfControlType::fromString(FormOfControlType::PASS_TYPE)
            )
        );
        $this->repository->store($curriculumDiscipline);

        $this->assertEquals(
            $curriculumDiscipline,
            $this->entityManager->find(CurriculumDiscipline::class, $id)
        );
    }

    /**
     * @throws ORMException
     */
    protected function setUp(): void
    {
        $container = new TestServiceContainer();
        $this->repository = $container->curriculumDisciplineRepository();
        $this->entityManager = $container->entityManager();
    }
}
