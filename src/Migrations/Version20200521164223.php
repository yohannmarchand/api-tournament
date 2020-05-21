<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521164223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_7A5BC50533D1A3E7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, tournament_id, player_1, player_2, point_1, point_2, type, created_at FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_1 VARCHAR(12) NOT NULL COLLATE BINARY, player_2 VARCHAR(12) NOT NULL COLLATE BINARY, point_1 INTEGER NOT NULL, point_2 INTEGER NOT NULL, type VARCHAR(20) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, CONSTRAINT FK_7A5BC50533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "match" (id, tournament_id, player_1, player_2, point_1, point_2, type, created_at) SELECT id, tournament_id, player_1, player_2, point_1, point_2, type, created_at FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE INDEX IDX_7A5BC50533D1A3E7 ON "match" (tournament_id)');
        $this->addSql('DROP INDEX IDX_BD5FB8D961190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, club_id, name, type, nb_poule, created_at, category FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, type VARCHAR(30) NOT NULL COLLATE BINARY, nb_poule INTEGER NOT NULL, created_at DATETIME NOT NULL, category VARCHAR(20) NOT NULL COLLATE BINARY, CONSTRAINT FK_BD5FB8D961190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tournament (id, club_id, name, type, nb_poule, created_at, category) SELECT id, club_id, name, type, nb_poule, created_at, category FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D961190A32 ON tournament (club_id)');
        $this->addSql('DROP INDEX IDX_C27C936999E6F5DF');
        $this->addSql('DROP INDEX IDX_C27C936933D1A3E7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__stage AS SELECT id, tournament_id, player_id, point, groups FROM stage');
        $this->addSql('DROP TABLE stage');
        $this->addSql('CREATE TABLE stage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_id INTEGER DEFAULT NULL, point INTEGER NOT NULL, groups VARCHAR(2) NOT NULL COLLATE BINARY, CONSTRAINT FK_C27C936933D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C27C936999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO stage (id, tournament_id, player_id, point, groups) SELECT id, tournament_id, player_id, point, groups FROM __temp__stage');
        $this->addSql('DROP TABLE __temp__stage');
        $this->addSql('CREATE INDEX IDX_C27C936999E6F5DF ON stage (player_id)');
        $this->addSql('CREATE INDEX IDX_C27C936933D1A3E7 ON stage (tournament_id)');
        $this->addSql('DROP INDEX IDX_98197A6561190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, club_id, name, slug FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, slug VARCHAR(52) NOT NULL COLLATE BINARY, CONSTRAINT FK_98197A6561190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player (id, club_id, name, slug) SELECT id, club_id, name, slug FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE INDEX IDX_98197A6561190A32 ON player (club_id)');
        $this->addSql('DROP INDEX IDX_E2FA3CE433D1A3E7');
        $this->addSql('DROP INDEX IDX_E2FA3CE499E6F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player_tournament AS SELECT player_id, tournament_id FROM player_tournament');
        $this->addSql('DROP TABLE player_tournament');
        $this->addSql('CREATE TABLE player_tournament (player_id INTEGER NOT NULL, tournament_id INTEGER NOT NULL, PRIMARY KEY(player_id, tournament_id), CONSTRAINT FK_E2FA3CE499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E2FA3CE433D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player_tournament (player_id, tournament_id) SELECT player_id, tournament_id FROM __temp__player_tournament');
        $this->addSql('DROP TABLE __temp__player_tournament');
        $this->addSql('CREATE INDEX IDX_E2FA3CE433D1A3E7 ON player_tournament (tournament_id)');
        $this->addSql('CREATE INDEX IDX_E2FA3CE499E6F5DF ON player_tournament (player_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_7A5BC50533D1A3E7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__match AS SELECT id, tournament_id, player_1, player_2, point_1, point_2, type, created_at FROM "match"');
        $this->addSql('DROP TABLE "match"');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_1 VARCHAR(12) NOT NULL, player_2 VARCHAR(12) NOT NULL, point_1 INTEGER NOT NULL, point_2 INTEGER NOT NULL, type VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO "match" (id, tournament_id, player_1, player_2, point_1, point_2, type, created_at) SELECT id, tournament_id, player_1, player_2, point_1, point_2, type, created_at FROM __temp__match');
        $this->addSql('DROP TABLE __temp__match');
        $this->addSql('CREATE INDEX IDX_7A5BC50533D1A3E7 ON "match" (tournament_id)');
        $this->addSql('DROP INDEX IDX_98197A6561190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, club_id, name, slug FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(52) NOT NULL)');
        $this->addSql('INSERT INTO player (id, club_id, name, slug) SELECT id, club_id, name, slug FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE INDEX IDX_98197A6561190A32 ON player (club_id)');
        $this->addSql('DROP INDEX IDX_E2FA3CE499E6F5DF');
        $this->addSql('DROP INDEX IDX_E2FA3CE433D1A3E7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player_tournament AS SELECT player_id, tournament_id FROM player_tournament');
        $this->addSql('DROP TABLE player_tournament');
        $this->addSql('CREATE TABLE player_tournament (player_id INTEGER NOT NULL, tournament_id INTEGER NOT NULL, PRIMARY KEY(player_id, tournament_id))');
        $this->addSql('INSERT INTO player_tournament (player_id, tournament_id) SELECT player_id, tournament_id FROM __temp__player_tournament');
        $this->addSql('DROP TABLE __temp__player_tournament');
        $this->addSql('CREATE INDEX IDX_E2FA3CE499E6F5DF ON player_tournament (player_id)');
        $this->addSql('CREATE INDEX IDX_E2FA3CE433D1A3E7 ON player_tournament (tournament_id)');
        $this->addSql('DROP INDEX IDX_C27C936933D1A3E7');
        $this->addSql('DROP INDEX IDX_C27C936999E6F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__stage AS SELECT id, tournament_id, player_id, point, groups FROM stage');
        $this->addSql('DROP TABLE stage');
        $this->addSql('CREATE TABLE stage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tournament_id INTEGER DEFAULT NULL, player_id INTEGER DEFAULT NULL, point INTEGER NOT NULL, groups VARCHAR(2) NOT NULL)');
        $this->addSql('INSERT INTO stage (id, tournament_id, player_id, point, groups) SELECT id, tournament_id, player_id, point, groups FROM __temp__stage');
        $this->addSql('DROP TABLE __temp__stage');
        $this->addSql('CREATE INDEX IDX_C27C936933D1A3E7 ON stage (tournament_id)');
        $this->addSql('CREATE INDEX IDX_C27C936999E6F5DF ON stage (player_id)');
        $this->addSql('DROP INDEX IDX_BD5FB8D961190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, club_id, name, type, nb_poule, created_at, category FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(30) NOT NULL, nb_poule INTEGER NOT NULL, created_at DATETIME NOT NULL, category VARCHAR(20) NOT NULL)');
        $this->addSql('INSERT INTO tournament (id, club_id, name, type, nb_poule, created_at, category) SELECT id, club_id, name, type, nb_poule, created_at, category FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D961190A32 ON tournament (club_id)');
    }
}
