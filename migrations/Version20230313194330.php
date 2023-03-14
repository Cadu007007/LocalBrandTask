<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313194330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) DEFAULT NULL, name_prefix VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, middle_initial VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, gender TINYINT(1) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, birth_time TIME DEFAULT NULL, age_years DOUBLE PRECISION DEFAULT NULL, joining_date DATE DEFAULT NULL, age_in_company DOUBLE PRECISION DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, place_name VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip INT DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, employee_id INT NOT NULL, UNIQUE INDEX UNIQ_5D9F75A18C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee');
    }
}
