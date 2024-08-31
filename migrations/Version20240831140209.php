<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831140209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, symbol VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE data (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, currency_id INTEGER DEFAULT NULL, symbol VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, symbol_native VARCHAR(255) NOT NULL, decimal_digits VARCHAR(255) NOT NULL, rounding INTEGER NOT NULL, code VARCHAR(255) NOT NULL, name_plural VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, CONSTRAINT FK_ADF3F36338248176 FOREIGN KEY (currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADF3F36338248176 ON data (currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE data');
    }
}
