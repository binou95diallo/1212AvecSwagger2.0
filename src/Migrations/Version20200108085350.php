<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200108085350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entreprise_horaires (entreprise_id INT NOT NULL, horaires_id INT NOT NULL, INDEX IDX_6B67170AA4AEAFEA (entreprise_id), INDEX IDX_6B67170A8AF49C8B (horaires_id), PRIMARY KEY(entreprise_id, horaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_horaires ADD CONSTRAINT FK_6B67170AA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_horaires ADD CONSTRAINT FK_6B67170A8AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6058C54515');
        $this->addSql('DROP INDEX UNIQ_D19FA6058C54515 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP horaire_id');
        $this->addSql('ALTER TABLE horaires ADD heure_fermeture VARCHAR(255) NOT NULL, ADD jour VARCHAR(255) NOT NULL, DROP lundi, DROP mardi, DROP jeudi, DROP vendredi, DROP samedi, DROP dimanche, CHANGE mercredi heure_ouverture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE entreprise_horaires');
        $this->addSql('ALTER TABLE entreprise ADD horaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6058C54515 FOREIGN KEY (horaire_id) REFERENCES horaires (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D19FA6058C54515 ON entreprise (horaire_id)');
        $this->addSql('ALTER TABLE horaires ADD lundi VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD mardi VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD mercredi VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD jeudi VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD vendredi VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD samedi VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD dimanche VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP heure_ouverture, DROP heure_fermeture, DROP jour');
    }
}
