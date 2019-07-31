<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729110951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, mat VARCHAR(255) NOT NULL, ninea VARCHAR(255) NOT NULL, rs VARCHAR(255) NOT NULL, rc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT DEFAULT NULL, compt_id INT DEFAULT NULL, date DATETIME NOT NULL, monaant DOUBLE PRECISION NOT NULL, INDEX IDX_1981A66D98DE13AC (partenaire_id), INDEX IDX_1981A66D765D939F (compt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_partenaire (user_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_9598659FA76ED395 (user_id), INDEX IDX_9598659F98DE13AC (partenaire_id), PRIMARY KEY(user_id, partenaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, montan DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D765D939F FOREIGN KEY (compt_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE user_partenaire ADD CONSTRAINT FK_9598659FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_partenaire ADD CONSTRAINT FK_9598659F98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D98DE13AC');
        $this->addSql('ALTER TABLE user_partenaire DROP FOREIGN KEY FK_9598659F98DE13AC');
        $this->addSql('ALTER TABLE user_partenaire DROP FOREIGN KEY FK_9598659FA76ED395');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D765D939F');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_partenaire');
        $this->addSql('DROP TABLE compte');
    }
}
