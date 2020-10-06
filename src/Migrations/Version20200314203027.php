<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200314203027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE podiums (id INT AUTO_INCREMENT NOT NULL, driver_id INT NOT NULL, first_places INT DEFAULT NULL, second_places INT DEFAULT NULL, third_places INT DEFAULT NULL, UNIQUE INDEX UNIQ_E95F4409C3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE podiums ADD CONSTRAINT FK_E95F4409C3423909 FOREIGN KEY (driver_id) REFERENCES drivers (id)');
        $this->addSql('ALTER TABLE drivers CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE podiums');
        $this->addSql('ALTER TABLE drivers CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
    }
}
