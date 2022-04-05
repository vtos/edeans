<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\AcademicDiscipline;

class AcademicDiscipline
{
    private AcademicDisciplineId $id;

    private AcademicDisciplineName $name;

    public function __construct(AcademicDisciplineId $id, AcademicDisciplineName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
