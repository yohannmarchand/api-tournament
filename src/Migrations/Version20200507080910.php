<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507080910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_1 VARCHAR(12) NOT NULL, player_2 VARCHAR(12) NOT NULL, point_1 INTEGER NOT NULL, point_2 INTEGER NOT NULL, type VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7A5BC50533D1A3E7 ON "match" (tournament_id)');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, winner_id INTEGER DEFAULT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(30) NOT NULL, nb_poule INTEGER NOT NULL, created_at DATETIME NOT NULL, category VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D95DFCD4B8 ON tournament (winner_id)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D961190A32 ON tournament (club_id)');
        $this->addSql('CREATE TABLE stage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_id INTEGER DEFAULT NULL, point INTEGER NOT NULL, groups VARCHAR(2) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C27C936933D1A3E7 ON stage (tournament_id)');
        $this->addSql('CREATE INDEX IDX_C27C936999E6F5DF ON stage (player_id)');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, password VARCHAR(75) NOT NULL, email VARCHAR(50) NOT NULL, api_token VARCHAR(120) DEFAULT NULL)');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(52) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_98197A6561190A32 ON player (club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE "match"');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE player');
    }
}
