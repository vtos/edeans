<?php

declare(strict_types=1);

namespace Edeans\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220407171613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table to store the curriculum discipline entity.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE curriculum_discipline (id VARCHAR(255) NOT NULL, term_id VARCHAR(255) DEFAULT NULL, form_of_control_id VARCHAR(255) DEFAULT NULL, academic_discipline_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80C06135E2C35FC ON curriculum_discipline (term_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80C06135783C41A4 ON curriculum_discipline (form_of_control_id)');
        $this->addSql('CREATE INDEX IDX_80C0613523CA3DEB ON curriculum_discipline (academic_discipline_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE curriculum_discipline');
    }
}
