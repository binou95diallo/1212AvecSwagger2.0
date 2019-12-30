<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191221184708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, localite_id INT NOT NULL, horaire_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, fixe VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, site_web VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, boite_postal VARCHAR(255) DEFAULT NULL, quartier VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, INDEX IDX_D19FA60924DD2B5 (localite_id), UNIQUE INDEX UNIQ_D19FA6058C54515 (horaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_domaine (entreprise_id INT NOT NULL, domaine_id INT NOT NULL, INDEX IDX_C04BB97FA4AEAFEA (entreprise_id), INDEX IDX_C04BB97F4272FC9F (domaine_id), PRIMARY KEY(entreprise_id, domaine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_localite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, type_localite_id INT NOT NULL, parent_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_F5D7E4A9D9540524 (type_localite_id), INDEX IDX_F5D7E4A9727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, fixe VARCHAR(255) NOT NULL, INDEX IDX_64C19AA9A4AEAFEA (entreprise_id), INDEX IDX_64C19AA9924DD2B5 (localite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parc_fixe (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, INDEX IDX_C64AADEBA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, lundi VARCHAR(255) DEFAULT NULL, mardi VARCHAR(255) DEFAULT NULL, mercredi VARCHAR(255) NOT NULL, jeudi VARCHAR(255) DEFAULT NULL, vendredi VARCHAR(255) DEFAULT NULL, samedi VARCHAR(255) DEFAULT NULL, dimanche VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6058C54515 FOREIGN KEY (horaire_id) REFERENCES horaires (id)');
        $this->addSql('ALTER TABLE entreprise_domaine ADD CONSTRAINT FK_C04BB97FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_domaine ADD CONSTRAINT FK_C04BB97F4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE localite ADD CONSTRAINT FK_F5D7E4A9D9540524 FOREIGN KEY (type_localite_id) REFERENCES type_localite (id)');
        $this->addSql('ALTER TABLE localite ADD CONSTRAINT FK_F5D7E4A9727ACA70 FOREIGN KEY (parent_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE parc_fixe ADD CONSTRAINT FK_C64AADEBA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entreprise_domaine DROP FOREIGN KEY FK_C04BB97FA4AEAFEA');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9A4AEAFEA');
        $this->addSql('ALTER TABLE parc_fixe DROP FOREIGN KEY FK_C64AADEBA4AEAFEA');
        $this->addSql('ALTER TABLE localite DROP FOREIGN KEY FK_F5D7E4A9D9540524');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60924DD2B5');
        $this->addSql('ALTER TABLE localite DROP FOREIGN KEY FK_F5D7E4A9727ACA70');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9924DD2B5');
        $this->addSql('ALTER TABLE entreprise_domaine DROP FOREIGN KEY FK_C04BB97F4272FC9F');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6058C54515');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_domaine');
        $this->addSql('DROP TABLE type_localite');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE parc_fixe');
        $this->addSql('DROP TABLE horaires');
    }
}
