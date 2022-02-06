<?php

declare(strict_types=1);

namespace Edeans\Domain\Model\FormOfControl;

interface FormOfControlRepository
{
    public function getOneById(FormOfControlId $id): FormOfControl;

    public function store(FormOfControl $formOfControl): void;

    public function remove(FormOfControl $formOfControl): void;
}
