<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220814121948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX authors_id_uindex ON authors');
        $this->addSql('ALTER TABLE authors CHANGE middlename middlename VARCHAR(255) NOT NULL, CHANGE books_count books_count INT NOT NULL');
        $this->addSql('DROP INDEX books_id_uindex ON books');
        $this->addSql('ALTER TABLE books CHANGE description description LONGTEXT NOT NULL, CHANGE img img LONGTEXT NOT NULL, CHANGE year year INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books CHANGE description description TEXT NOT NULL, CHANGE img img TEXT DEFAULT NULL, CHANGE year year INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX books_id_uindex ON books (id)');
        $this->addSql('ALTER TABLE authors CHANGE middlename middlename VARCHAR(255) DEFAULT NULL, CHANGE books_count books_count INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX authors_id_uindex ON authors (id)');
    }
}
