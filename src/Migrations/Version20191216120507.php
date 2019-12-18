<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216120507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6098260155');
        $this->addSql('ALTER TABLE entreprise_secteur_activites DROP FOREIGN KEY FK_CC772264532830B5');
        $this->addSql('DROP TABLE entreprise_secteur_activites');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE secteur_activites');
        $this->addSql('DROP INDEX IDX_D19FA6098260155 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP region_id, DROP fixe, DROP commune, DROP horaires, DROP heure_ouverture, DROP heure_fermeture');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entreprise_secteur_activites (entreprise_id INT NOT NULL, secteur_activites_id INT NOT NULL, INDEX IDX_CC772264532830B5 (secteur_activites_id), INDEX IDX_CC772264A4AEAFEA (entreprise_id), PRIMARY KEY(entreprise_id, secteur_activites_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE secteur_activites (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE entreprise_secteur_activites ADD CONSTRAINT FK_CC772264532830B5 FOREIGN KEY (secteur_activites_id) REFERENCES secteur_activites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_secteur_activites ADD CONSTRAINT FK_CC772264A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise ADD region_id INT NOT NULL, ADD fixe VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD commune VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD horaires VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD heure_ouverture TIME NOT NULL, ADD heure_fermeture TIME NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6098260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_D19FA6098260155 ON entreprise (region_id)');
    }
}
