<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210112204317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE survey RENAME COLUMN date TO survey_timestamp');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE survey RENAME COLUMN survey_timestamp TO date');
    }
}
