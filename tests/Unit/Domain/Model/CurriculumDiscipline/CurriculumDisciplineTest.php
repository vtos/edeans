<?php

declare(strict_types=1);

namespace Unit\Domain\Model\CurriculumDiscipline;

use Edeans\Domain\Model\AcademicDiscipline\AcademicDiscipline;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineId;
use Edeans\Domain\Model\AcademicDiscipline\AcademicDisciplineName;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDiscipline;
use Edeans\Domain\Model\CurriculumDiscipline\CurriculumDisciplineId;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\FormOfControl\FormOfControlId;
use Edeans\Domain\Model\FormOfControl\FormOfControlName;
use Edeans\Domain\Model\FormOfControl\FormOfControlType;
use Edeans\Domain\Model\Term\EnrollingStatus;
use Edeans\Domain\Model\Term\TemporalStatus;
use Edeans\Domain\Model\Term\Term;
use Edeans\Domain\Model\Term\TermId;
use Edeans\Domain\Model\Term\TermName;
use Edeans\Infrastructure\RamseyUuid;
use PHPUnit\Framework\TestCase;

final class CurriculumDisciplineTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_change_form_of_control(): void
    {
        $ramseyUuid = new RamseyUuid();

        $id = CurriculumDisciplineId::fromUuid($ramseyUuid);
        $academicDiscipline = new AcademicDiscipline(
            AcademicDisciplineId::fromUuid($ramseyUuid),
            AcademicDisciplineName::fromString('English')
        );
        $term = Term::withDefaultStatus(TermId::fromUuid($ramseyUuid), TermName::fromString('Term 1'));
        $formOfControl = new FormOfControl(
            FormOfControlId::fromUuid(new RamseyUuid()),
            FormOfControlName::fromString('Credit'),
            FormOfControlType::fromString(FormOfControlType::GRADE_TYPE)
        );
        $curriculumDiscipline = new CurriculumDiscipline($id, $academicDiscipline, $term, $formOfControl);

        $gradeFormOfControl = new FormOfControl(
            FormOfControlId::fromUuid($ramseyUuid),
            FormOfControlName::fromString('Exam'),
            FormOfControlType::fromString(FormOfControlType::GRADE_TYPE)
        );
        $curriculumDiscipline->change_form_of_control($gradeFormOfControl);

        $this->assertEquals(
            new CurriculumDiscipline($id, $academicDiscipline, $term, $gradeFormOfControl),
            $curriculumDiscipline
        );
    }
}
