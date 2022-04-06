<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\CurriculumDiscipline;

interface CurriculumDisciplineRepository
{
    public function store(CurriculumDiscipline $curriculumDiscipline): void;

    public function remove(CurriculumDiscipline $curriculumDiscipline): void;
}
