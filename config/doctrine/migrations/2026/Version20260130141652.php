<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260130141652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_ability (created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, ability_id VARCHAR(64) NOT NULL, id VARCHAR(64) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE character_base (created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, att_arcanum INT NOT NULL, att_charisma INT NOT NULL, att_constitution INT NOT NULL, att_dexterity INT NOT NULL, att_strength INT NOT NULL, life INT NOT NULL, armour INT NOT NULL, id VARCHAR(64) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE character_character_ability (character_id VARCHAR(64) NOT NULL, character_ability_id VARCHAR(64) NOT NULL, INDEX IDX_5BB187181136BE75 (character_id), INDEX IDX_5BB18718319A6134 (character_ability_id), PRIMARY KEY (character_id, character_ability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE character_character_ability ADD CONSTRAINT FK_5BB187181136BE75 FOREIGN KEY (character_id) REFERENCES character_base (id)');
        $this->addSql('ALTER TABLE character_character_ability ADD CONSTRAINT FK_5BB18718319A6134 FOREIGN KEY (character_ability_id) REFERENCES character_ability (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_character_ability DROP FOREIGN KEY FK_5BB187181136BE75');
        $this->addSql('ALTER TABLE character_character_ability DROP FOREIGN KEY FK_5BB18718319A6134');
        $this->addSql('DROP TABLE character_ability');
        $this->addSql('DROP TABLE character_base');
        $this->addSql('DROP TABLE character_character_ability');
    }
}
