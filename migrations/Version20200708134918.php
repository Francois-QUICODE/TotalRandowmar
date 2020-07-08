<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708134918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campaign (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE dlc (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_AD6CAEA7E48FD905 ON dlc (game_id)');
        $this->addSql('CREATE TABLE effect (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, icon CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B66091F2C54C8C93 ON effect (type_id)');
        $this->addSql('CREATE TABLE effect_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('CREATE TABLE lord (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dlc_id INTEGER NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, portrait CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_44E9A58FCEF6326C ON lord (dlc_id)');
        $this->addSql('CREATE INDEX IDX_44E9A58F6E59D40D ON lord (race_id)');
        $this->addSql('CREATE TABLE lord_campaign (lord_id INTEGER NOT NULL, campaign_id INTEGER NOT NULL, PRIMARY KEY(lord_id, campaign_id))');
        $this->addSql('CREATE INDEX IDX_6865DA75868E8BB9 ON lord_campaign (lord_id)');
        $this->addSql('CREATE INDEX IDX_6865DA75F639F774 ON lord_campaign (campaign_id)');
        $this->addSql('CREATE TABLE lord_effect (lord_id INTEGER NOT NULL, effect_id INTEGER NOT NULL, PRIMARY KEY(lord_id, effect_id))');
        $this->addSql('CREATE INDEX IDX_496E06F3868E8BB9 ON lord_effect (lord_id)');
        $this->addSql('CREATE INDEX IDX_496E06F3F5E9B83B ON lord_effect (effect_id)');
        $this->addSql('CREATE TABLE race (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE race_unit (race_id INTEGER NOT NULL, unit_id INTEGER NOT NULL, PRIMARY KEY(race_id, unit_id))');
        $this->addSql('CREATE INDEX IDX_81C61C1C6E59D40D ON race_unit (race_id)');
        $this->addSql('CREATE INDEX IDX_81C61C1CF8BD700D ON race_unit (unit_id)');
        $this->addSql('CREATE TABLE racial_feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, image CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_F7454D3D6E59D40D ON racial_feature (race_id)');
        $this->addSql('CREATE TABLE unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE dlc');
        $this->addSql('DROP TABLE effect');
        $this->addSql('DROP TABLE effect_type');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE lord');
        $this->addSql('DROP TABLE lord_campaign');
        $this->addSql('DROP TABLE lord_effect');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_unit');
        $this->addSql('DROP TABLE racial_feature');
        $this->addSql('DROP TABLE unit');
    }
}
