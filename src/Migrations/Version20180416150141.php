<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416150141 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE magasin_rayon (magasin_id INT NOT NULL, rayon_id INT NOT NULL, INDEX IDX_818AB20B20096AE3 (magasin_id), INDEX IDX_818AB20BD3202E52 (rayon_id), PRIMARY KEY(magasin_id, rayon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE magasin_rayon ADD CONSTRAINT FK_818AB20B20096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magasin_rayon ADD CONSTRAINT FK_818AB20BD3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE magasin_rayon');
    }
}
