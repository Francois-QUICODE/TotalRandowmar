<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709071908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_AD6CAEA7E48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dlc AS SELECT id, game_id, name, description FROM dlc');
        $this->addSql('DROP TABLE dlc');
        $this->addSql('CREATE TABLE dlc (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_AD6CAEA7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO dlc (id, game_id, name, description) SELECT id, game_id, name, description FROM __temp__dlc');
        $this->addSql('DROP TABLE __temp__dlc');
        $this->addSql('CREATE INDEX IDX_AD6CAEA7E48FD905 ON dlc (game_id)');
        $this->addSql('DROP INDEX IDX_B66091F2C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__effect AS SELECT id, type_id, name, description, icon FROM effect');
        $this->addSql('DROP TABLE effect');
        $this->addSql('CREATE TABLE effect (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, icon CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_B66091F2C54C8C93 FOREIGN KEY (type_id) REFERENCES effect_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO effect (id, type_id, name, description, icon) SELECT id, type_id, name, description, icon FROM __temp__effect');
        $this->addSql('DROP TABLE __temp__effect');
        $this->addSql('CREATE INDEX IDX_B66091F2C54C8C93 ON effect (type_id)');
        $this->addSql('DROP INDEX IDX_44E9A58F6E59D40D');
        $this->addSql('DROP INDEX IDX_44E9A58FCEF6326C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord AS SELECT id, dlc_id, race_id, name, portrait, faction FROM lord');
        $this->addSql('DROP TABLE lord');
        $this->addSql('CREATE TABLE lord (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dlc_id INTEGER NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, portrait CLOB NOT NULL COLLATE BINARY, faction VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_44E9A58FCEF6326C FOREIGN KEY (dlc_id) REFERENCES dlc (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_44E9A58F6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lord (id, dlc_id, race_id, name, portrait, faction) SELECT id, dlc_id, race_id, name, portrait, faction FROM __temp__lord');
        $this->addSql('DROP TABLE __temp__lord');
        $this->addSql('CREATE INDEX IDX_44E9A58F6E59D40D ON lord (race_id)');
        $this->addSql('CREATE INDEX IDX_44E9A58FCEF6326C ON lord (dlc_id)');
        $this->addSql('DROP INDEX IDX_6865DA75F639F774');
        $this->addSql('DROP INDEX IDX_6865DA75868E8BB9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_campaign AS SELECT lord_id, campaign_id FROM lord_campaign');
        $this->addSql('DROP TABLE lord_campaign');
        $this->addSql('CREATE TABLE lord_campaign (lord_id INTEGER NOT NULL, campaign_id INTEGER NOT NULL, PRIMARY KEY(lord_id, campaign_id), CONSTRAINT FK_6865DA75868E8BB9 FOREIGN KEY (lord_id) REFERENCES lord (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6865DA75F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lord_campaign (lord_id, campaign_id) SELECT lord_id, campaign_id FROM __temp__lord_campaign');
        $this->addSql('DROP TABLE __temp__lord_campaign');
        $this->addSql('CREATE INDEX IDX_6865DA75F639F774 ON lord_campaign (campaign_id)');
        $this->addSql('CREATE INDEX IDX_6865DA75868E8BB9 ON lord_campaign (lord_id)');
        $this->addSql('DROP INDEX IDX_496E06F3F5E9B83B');
        $this->addSql('DROP INDEX IDX_496E06F3868E8BB9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_effect AS SELECT lord_id, effect_id FROM lord_effect');
        $this->addSql('DROP TABLE lord_effect');
        $this->addSql('CREATE TABLE lord_effect (lord_id INTEGER NOT NULL, effect_id INTEGER NOT NULL, PRIMARY KEY(lord_id, effect_id), CONSTRAINT FK_496E06F3868E8BB9 FOREIGN KEY (lord_id) REFERENCES lord (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_496E06F3F5E9B83B FOREIGN KEY (effect_id) REFERENCES effect (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lord_effect (lord_id, effect_id) SELECT lord_id, effect_id FROM __temp__lord_effect');
        $this->addSql('DROP TABLE __temp__lord_effect');
        $this->addSql('CREATE INDEX IDX_496E06F3F5E9B83B ON lord_effect (effect_id)');
        $this->addSql('CREATE INDEX IDX_496E06F3868E8BB9 ON lord_effect (lord_id)');
        $this->addSql('DROP INDEX IDX_FABBD312868E8BB9');
        $this->addSql('DROP INDEX IDX_FABBD312F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_unit AS SELECT lord_id, unit_id FROM lord_unit');
        $this->addSql('DROP TABLE lord_unit');
        $this->addSql('CREATE TABLE lord_unit (lord_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, PRIMARY KEY(lord_id, unit_id), CONSTRAINT FK_FABBD312868E8BB9 FOREIGN KEY (lord_id) REFERENCES lord (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FABBD312F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lord_unit (lord_id, unit_id) SELECT lord_id, unit_id FROM __temp__lord_unit');
        $this->addSql('DROP TABLE __temp__lord_unit');
        $this->addSql('CREATE INDEX IDX_FABBD312868E8BB9 ON lord_unit (lord_id)');
        $this->addSql('CREATE INDEX IDX_FABBD312F8BD700D ON lord_unit (unit_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__race AS SELECT id, name FROM race');
        $this->addSql('DROP TABLE race');
        $this->addSql('CREATE TABLE race (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dlc_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_DA6FBBAFCEF6326C FOREIGN KEY (dlc_id) REFERENCES dlc (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO race (id, name) SELECT id, name FROM __temp__race');
        $this->addSql('DROP TABLE __temp__race');
        $this->addSql('CREATE INDEX IDX_DA6FBBAFCEF6326C ON race (dlc_id)');
        $this->addSql('DROP INDEX IDX_81C61C1CF8BD700D');
        $this->addSql('DROP INDEX IDX_81C61C1C6E59D40D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__race_unit AS SELECT race_id, unit_id FROM race_unit');
        $this->addSql('DROP TABLE race_unit');
        $this->addSql('CREATE TABLE race_unit (race_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, PRIMARY KEY(race_id, unit_id), CONSTRAINT FK_81C61C1C6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_81C61C1CF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO race_unit (race_id, unit_id) SELECT race_id, unit_id FROM __temp__race_unit');
        $this->addSql('DROP TABLE __temp__race_unit');
        $this->addSql('CREATE INDEX IDX_81C61C1CF8BD700D ON race_unit (unit_id)');
        $this->addSql('CREATE INDEX IDX_81C61C1C6E59D40D ON race_unit (race_id)');
        $this->addSql('DROP INDEX IDX_F7454D3D6E59D40D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racial_feature AS SELECT id, race_id, name, description, image FROM racial_feature');
        $this->addSql('DROP TABLE racial_feature');
        $this->addSql('CREATE TABLE racial_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, image CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_F7454D3D6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO racial_feature (id, race_id, name, description, image) SELECT id, race_id, name, description, image FROM __temp__racial_feature');
        $this->addSql('DROP TABLE __temp__racial_feature');
        $this->addSql('CREATE INDEX IDX_F7454D3D6E59D40D ON racial_feature (race_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_AD6CAEA7E48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dlc AS SELECT id, game_id, name, description FROM dlc');
        $this->addSql('DROP TABLE dlc');
        $this->addSql('CREATE TABLE dlc (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO dlc (id, game_id, name, description) SELECT id, game_id, name, description FROM __temp__dlc');
        $this->addSql('DROP TABLE __temp__dlc');
        $this->addSql('CREATE INDEX IDX_AD6CAEA7E48FD905 ON dlc (game_id)');
        $this->addSql('DROP INDEX IDX_B66091F2C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__effect AS SELECT id, type_id, name, description, icon FROM effect');
        $this->addSql('DROP TABLE effect');
        $this->addSql('CREATE TABLE effect (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, icon CLOB NOT NULL)');
        $this->addSql('INSERT INTO effect (id, type_id, name, description, icon) SELECT id, type_id, name, description, icon FROM __temp__effect');
        $this->addSql('DROP TABLE __temp__effect');
        $this->addSql('CREATE INDEX IDX_B66091F2C54C8C93 ON effect (type_id)');
        $this->addSql('DROP INDEX IDX_44E9A58FCEF6326C');
        $this->addSql('DROP INDEX IDX_44E9A58F6E59D40D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord AS SELECT id, dlc_id, race_id, name, portrait, faction FROM lord');
        $this->addSql('DROP TABLE lord');
        $this->addSql('CREATE TABLE lord (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dlc_id INTEGER NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, portrait CLOB NOT NULL, faction VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO lord (id, dlc_id, race_id, name, portrait, faction) SELECT id, dlc_id, race_id, name, portrait, faction FROM __temp__lord');
        $this->addSql('DROP TABLE __temp__lord');
        $this->addSql('CREATE INDEX IDX_44E9A58FCEF6326C ON lord (dlc_id)');
        $this->addSql('CREATE INDEX IDX_44E9A58F6E59D40D ON lord (race_id)');
        $this->addSql('DROP INDEX IDX_6865DA75868E8BB9');
        $this->addSql('DROP INDEX IDX_6865DA75F639F774');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_campaign AS SELECT lord_id, campaign_id FROM lord_campaign');
        $this->addSql('DROP TABLE lord_campaign');
        $this->addSql('CREATE TABLE lord_campaign (lord_id INTEGER NOT NULL, campaign_id INTEGER NOT NULL, PRIMARY KEY(lord_id, campaign_id))');
        $this->addSql('INSERT INTO lord_campaign (lord_id, campaign_id) SELECT lord_id, campaign_id FROM __temp__lord_campaign');
        $this->addSql('DROP TABLE __temp__lord_campaign');
        $this->addSql('CREATE INDEX IDX_6865DA75868E8BB9 ON lord_campaign (lord_id)');
        $this->addSql('CREATE INDEX IDX_6865DA75F639F774 ON lord_campaign (campaign_id)');
        $this->addSql('DROP INDEX IDX_496E06F3868E8BB9');
        $this->addSql('DROP INDEX IDX_496E06F3F5E9B83B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_effect AS SELECT lord_id, effect_id FROM lord_effect');
        $this->addSql('DROP TABLE lord_effect');
        $this->addSql('CREATE TABLE lord_effect (lord_id INTEGER NOT NULL, effect_id INTEGER NOT NULL, PRIMARY KEY(lord_id, effect_id))');
        $this->addSql('INSERT INTO lord_effect (lord_id, effect_id) SELECT lord_id, effect_id FROM __temp__lord_effect');
        $this->addSql('DROP TABLE __temp__lord_effect');
        $this->addSql('CREATE INDEX IDX_496E06F3868E8BB9 ON lord_effect (lord_id)');
        $this->addSql('CREATE INDEX IDX_496E06F3F5E9B83B ON lord_effect (effect_id)');
        $this->addSql('DROP INDEX IDX_FABBD312868E8BB9');
        $this->addSql('DROP INDEX IDX_FABBD312F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lord_unit AS SELECT lord_id, unit_id FROM lord_unit');
        $this->addSql('DROP TABLE lord_unit');
        $this->addSql('CREATE TABLE lord_unit (lord_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, PRIMARY KEY(lord_id, unit_id))');
        $this->addSql('INSERT INTO lord_unit (lord_id, unit_id) SELECT lord_id, unit_id FROM __temp__lord_unit');
        $this->addSql('DROP TABLE __temp__lord_unit');
        $this->addSql('CREATE INDEX IDX_FABBD312868E8BB9 ON lord_unit (lord_id)');
        $this->addSql('CREATE INDEX IDX_FABBD312F8BD700D ON lord_unit (unit_id)');
        $this->addSql('DROP INDEX IDX_DA6FBBAFCEF6326C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__race AS SELECT id, name FROM race');
        $this->addSql('DROP TABLE race');
        $this->addSql('CREATE TABLE race (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO race (id, name) SELECT id, name FROM __temp__race');
        $this->addSql('DROP TABLE __temp__race');
        $this->addSql('DROP INDEX IDX_81C61C1C6E59D40D');
        $this->addSql('DROP INDEX IDX_81C61C1CF8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__race_unit AS SELECT race_id, unit_id FROM race_unit');
        $this->addSql('DROP TABLE race_unit');
        $this->addSql('CREATE TABLE race_unit (race_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, PRIMARY KEY(race_id, unit_id))');
        $this->addSql('INSERT INTO race_unit (race_id, unit_id) SELECT race_id, unit_id FROM __temp__race_unit');
        $this->addSql('DROP TABLE __temp__race_unit');
        $this->addSql('CREATE INDEX IDX_81C61C1C6E59D40D ON race_unit (race_id)');
        $this->addSql('CREATE INDEX IDX_81C61C1CF8BD700D ON race_unit (unit_id)');
        $this->addSql('DROP INDEX IDX_F7454D3D6E59D40D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__racial_feature AS SELECT id, race_id, name, description, image FROM racial_feature');
        $this->addSql('DROP TABLE racial_feature');
        $this->addSql('CREATE TABLE racial_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, image CLOB NOT NULL)');
        $this->addSql('INSERT INTO racial_feature (id, race_id, name, description, image) SELECT id, race_id, name, description, image FROM __temp__racial_feature');
        $this->addSql('DROP TABLE __temp__racial_feature');
        $this->addSql('CREATE INDEX IDX_F7454D3D6E59D40D ON racial_feature (race_id)');
    }
}
