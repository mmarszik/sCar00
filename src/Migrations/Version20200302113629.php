<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302113629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE reservations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cars_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reservations (id INT NOT NULL, id_car_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, date_from TIMESTAMP(0) WITH TIME ZONE NOT NULL, date_to TIMESTAMP(0) WITH TIME ZONE NOT NULL, insurance BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4DA239E5F14372 ON reservations (id_car_id)');
        $this->addSql('CREATE TABLE cars (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(4096) DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239E5F14372 FOREIGN KEY (id_car_id) REFERENCES cars (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reservations DROP CONSTRAINT FK_4DA239E5F14372');
        $this->addSql('DROP SEQUENCE reservations_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cars_id_seq CASCADE');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE cars');
    }
}
