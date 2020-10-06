<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426180520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE drivers CHANGE team_id team_id INT NOT NULL, CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
        $this->addSql('ALTER TABLE podiums CHANGE driver_id driver_id INT NOT NULL, CHANGE first_places first_places INT DEFAULT NULL, CHANGE second_places second_places INT DEFAULT NULL, CHANGE third_places third_places INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE drivers CHANGE team_id team_id INT DEFAULT NULL, CHANGE points points INT DEFAULT NULL, CHANGE apperances apperances INT DEFAULT NULL');
        $this->addSql('ALTER TABLE podiums CHANGE driver_id driver_id INT DEFAULT NULL, CHANGE first_places first_places INT DEFAULT NULL, CHANGE second_places second_places INT DEFAULT NULL, CHANGE third_places third_places INT DEFAULT NULL');
    }
}
