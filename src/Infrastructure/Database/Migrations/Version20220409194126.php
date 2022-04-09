<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220409194126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table to store the term entity.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE term (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, temporal_status VARCHAR(255) NOT NULL, enrolling_status VARCHAR(255) NOT NULL, visibility_status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE term');
    }
}
