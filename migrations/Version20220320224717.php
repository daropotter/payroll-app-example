<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320224717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE department_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE salary_policy_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE department (id INT NOT NULL, salary_policy_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD1DE18A5ABC96DA ON department (salary_policy_id)');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, department_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, base_salary NUMERIC(10, 2) NOT NULL, start_of_service DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A1AE80F5DF ON employee (department_id)');
        $this->addSql('COMMENT ON COLUMN employee.start_of_service IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE salary_policy (id INT NOT NULL, name VARCHAR(255) NOT NULL, percentage DOUBLE PRECISION DEFAULT NULL, addition NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A5ABC96DA FOREIGN KEY (salary_policy_id) REFERENCES salary_policy (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A1AE80F5DF');
        $this->addSql('ALTER TABLE department DROP CONSTRAINT FK_CD1DE18A5ABC96DA');
        $this->addSql('DROP SEQUENCE department_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE salary_policy_id_seq CASCADE');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE salary_policy');
    }
}
