<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261008081331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel (id INT AUTO_INCREMENT NOT NULL, date_appel DATETIME NOT NULL, horodatage_validation DATETIME DEFAULT NULL, verrouille TINYINT NOT NULL, creneau_id INT NOT NULL, INDEX IDX_130D3BD7D0729A9 (creneau_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, role VARCHAR(30) NOT NULL, enseignant_id INT NOT NULL, UNIQUE INDEX UNIQ_CFF65260E455FCC0 (enseignant_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE creneau (id INT AUTO_INCREMENT NOT NULL, jour_semaine VARCHAR(20) NOT NULL, heure_debut VARCHAR(10) NOT NULL, heure_fin VARCHAR(10) NOT NULL, classe_id INT NOT NULL, enseignant_id INT NOT NULL, INDEX IDX_F9668B5F8F5EA509 (classe_id), INDEX IDX_F9668B5FE455FCC0 (enseignant_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, classe_id INT NOT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE justificatif (id INT AUTO_INCREMENT NOT NULL, motif LONGTEXT NOT NULL, statut VARCHAR(20) NOT NULL, presence_id INT NOT NULL, UNIQUE INDEX UNIQ_90D3C5DCF328FFC4 (presence_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(20) NOT NULL, duree_retard_min INT DEFAULT NULL, appel_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_6977C7A5270B0E02 (appel_id), INDEX IDX_6977C7A5A6CC7B2 (eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE appel ADD CONSTRAINT FK_130D3BD7D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneau (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5FE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE justificatif ADD CONSTRAINT FK_90D3C5DCF328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5270B0E02 FOREIGN KEY (appel_id) REFERENCES appel (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel DROP FOREIGN KEY FK_130D3BD7D0729A9');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260E455FCC0');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F8F5EA509');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5FE455FCC0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE justificatif DROP FOREIGN KEY FK_90D3C5DCF328FFC4');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5270B0E02');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5A6CC7B2');
        $this->addSql('DROP TABLE appel');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE creneau');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE justificatif');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
