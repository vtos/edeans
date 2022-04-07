<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220407113939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table to store the academic discipline entity.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE academic_discipline (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE academic_discipline');
    }
}
