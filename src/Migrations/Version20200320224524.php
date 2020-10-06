<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320224524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE drivers ADD pole_positions INT NOT NULL, CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
        $this->addSql('ALTER TABLE podiums CHANGE first_places first_places INT DEFAULT NULL, CHANGE second_places second_places INT DEFAULT NULL, CHANGE third_places third_places INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE drivers DROP pole_positions, CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
        $this->addSql('ALTER TABLE podiums CHANGE first_places first_places INT DEFAULT NULL, CHANGE second_places second_places INT DEFAULT NULL, CHANGE third_places third_places INT DEFAULT NULL');
    }
}
