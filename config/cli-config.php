<?php

/**
 * This file is specific for the Doctrine ORM, but should be placed here as Doctrine looks for it in a hard-coded
 * location.
 */

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Edeans\Infrastructure\TestServiceContainer;

return DependencyFactory::fromEntityManager(
    new PhpFile(__DIR__ . '/doctrine/migrations.php'),
    new ExistingEntityManager(
        (new TestServiceContainer())->entityManager()
    )
);
