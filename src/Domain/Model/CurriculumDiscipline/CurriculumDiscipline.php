<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\CurriculumDiscipline;

use Edeans\Domain\Model\AcademicDiscipline\AcademicDiscipline;
use Edeans\Domain\Model\FormOfControl\FormOfControl;
use Edeans\Domain\Model\Term\Term;

class CurriculumDiscipline
{
    private CurriculumDisciplineId $id;

    private AcademicDiscipline $academicDiscipline;

    private Term $term;

    private FormOfControl $formOfControl;

    public function __construct(
        CurriculumDisciplineId $id,
        AcademicDiscipline $academicDiscipline,
        Term $term,
        FormOfControl $formOfControl
    ) {
        $this->id = $id;
        $this->academicDiscipline = $academicDiscipline;
        $this->term = $term;
        $this->formOfControl = $formOfControl;
    }

    public function change_form_of_control(FormOfControl $formOfControl): void
    {
        $this->formOfControl = $formOfControl;
    }
}
