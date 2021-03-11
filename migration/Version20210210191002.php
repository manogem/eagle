<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210191002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE survey RENAME TO measurement');
        $this->addSql('ALTER TABLE measurement RENAME COLUMN survey_timestamp TO measurement_timestamp');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE measurement RENAME TO survey');
        $this->addSql('ALTER TABLE survey RENAME COLUMN measurement_timestamp TO survey_timestamp');
    }
}
