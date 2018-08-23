<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180817204133 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE audit_item (id INT AUTO_INCREMENT NOT NULL, audit_id INT NOT NULL, item_id INT NOT NULL, statut INT NOT NULL, INDEX IDX_39BBCB1ABD29F359 (audit_id), INDEX IDX_39BBCB1A126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit_item ADD CONSTRAINT FK_39BBCB1ABD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE audit_item ADD CONSTRAINT FK_39BBCB1A126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE audit_item');
    }
}
