<?php

declare(strict_types=1);

namespace Contract\Infrastructure\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDiscipline;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineId;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineName;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineRepository;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDiscipline;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineId;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlRepository;
use Edeans\Domain\Model\FormOfControl\FormOfControlType;
use Edeans\Domain\Model\Term\Term;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Domain\Model\Term\TermRepository;
use Edeans\Infrastructure\RamseyUuid;
use Edeans\Infrastructure\TestServiceContainer;
use PHPUnit\Framework\TestCase;

final class CurriculumDisciplineRepositoryUsingORMTest extends TestCase
{
    private FormOfControlRepository $formOfControlRepository;

    private AcademicDisciplineRepository $academicDisciplineRepository;

    private TermRepository $termRepository;

    private CurriculumDisciplineRepository $curriculumDisciplineRepository;

    private EntityManager $entityManager;

    /**
     * @test
     */
    public function it_stores_and_removes_a_curriculum_discipline(): void
    {
        $academicDiscipline = new AcademicDiscipline(
            AcademicDisciplineId::fromUuid(new RamseyUuid()),
            AcademicDisciplineName::fromString('English')
        );
        $this->academicDisciplineRepository->store($academicDiscipline);

        $term = Term::withDefaultStatus(TermId::fromUuid(new RamseyUuid()), TermName::fromString('Term 1'));
        $this->termRepository->store($term);

        $formOfControl = new FormOfControl(
            FormOfControlId::fromUuid(new RamseyUuid()),
            FormOfControlName::fromString('Exam'),
            FormOfControlType::fromString(FormOfControlType::GRADE_TYPE)
        );
        $this->formOfControlRepository->store($formOfControl);

        $id = CurriculumDisciplineId::fromUuid(new RamseyUuid());
        $curriculumDiscipline = new CurriculumDiscipline($id, $academicDiscipline, $term, $formOfControl);
        $this->curriculumDisciplineRepository->store($curriculumDiscipline);

        $this->assertEquals(
            $curriculumDiscipline,
            $this->entityManager->find(CurriculumDiscipline::class, $id)
        );

        // Now remove it
        $this->curriculumDisciplineRepository->remove($curriculumDiscipline);
        $this->assertEquals(
            0,
            $this->entityManager->getRepository(CurriculumDiscipline::class)->count([])
        );
    }

    /**
     * @throws ORMException
     */
    protected function setUp(): void
    {
        $container = new TestServiceContainer();
        $this->formOfControlRepository = $container->formOfControlRepository();
        $this->academicDisciplineRepository = $container->academicDisciplineRepository();
        $this->termRepository = $container->termRepository();
        $this->curriculumDisciplineRepository = $container->curriculumDisciplineRepository();
        $this->entityManager = $container->entityManager();
    }
}
