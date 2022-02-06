<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220205171750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table to store the form of control entity.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE form_of_control (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE form_of_control');
    }
}
