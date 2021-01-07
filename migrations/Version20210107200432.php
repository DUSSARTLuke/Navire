<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210107200432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administration (idrole INT NOT NULL, iduser INT NOT NULL, INDEX IDX_9FDD0D1884A67BCA (idrole), INDEX IDX_9FDD0D185E5C27E9 (iduser), PRIMARY KEY(idrole, iduser)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administration ADD CONSTRAINT FK_9FDD0D1884A67BCA FOREIGN KEY (idrole) REFERENCES role (id)');
        $this->addSql('ALTER TABLE administration ADD CONSTRAINT FK_9FDD0D185E5C27E9 FOREIGN KEY (iduser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user DROP roles');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administration DROP FOREIGN KEY FK_9FDD0D1884A67BCA');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE administration');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
    }
}
