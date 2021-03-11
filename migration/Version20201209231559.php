<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201209231559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL UNIQUE, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL UNIQUE, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL UNIQUE, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE survey (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subject_name VARCHAR(255) NOT NULL, type INT NOT NULL, date DATETIME NOT NULL, payload TEXT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE survey');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE app_users');
    }
}
