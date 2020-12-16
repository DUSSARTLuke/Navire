<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216142030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ais_ship_type_ais_ship_type (ais_ship_type_source INT NOT NULL, ais_ship_type_target INT NOT NULL, INDEX IDX_56D6F52CE55133F9 (ais_ship_type_source), INDEX IDX_56D6F52CFCB46376 (ais_ship_type_target), PRIMARY KEY(ais_ship_type_source, ais_ship_type_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ais_ship_type_ais_ship_type ADD CONSTRAINT FK_56D6F52CE55133F9 FOREIGN KEY (ais_ship_type_source) REFERENCES aisshiptype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ais_ship_type_ais_ship_type ADD CONSTRAINT FK_56D6F52CFCB46376 FOREIGN KEY (ais_ship_type_target) REFERENCES aisshiptype (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE porttypecompatible');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE porttypecompatible (idaistype INT NOT NULL, idport INT NOT NULL, INDEX IDX_2C02FFDB53BA86F9 (idaistype), INDEX IDX_2C02FFDB905EAC6C (idport), PRIMARY KEY(idaistype, idport)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB53BA86F9 FOREIGN KEY (idaistype) REFERENCES aisshiptype (id)');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB905EAC6C FOREIGN KEY (idport) REFERENCES port (id)');
        $this->addSql('DROP TABLE ais_ship_type_ais_ship_type');
    }
}
