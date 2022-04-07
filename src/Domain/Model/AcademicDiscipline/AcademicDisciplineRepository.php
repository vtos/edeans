<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\AcademicDiscipline;

interface AcademicDisciplineRepository
{
    public function store(AcademicDiscipline $discipline): void;

    public function remove(AcademicDiscipline $discipline): void;
}
