<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822155120 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit_item ADD zone_id INT NOT NULL, ADD rayons_magasin_id INT NOT NULL');
        $this->addSql('ALTER TABLE audit_item ADD CONSTRAINT FK_39BBCB1A9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE audit_item ADD CONSTRAINT FK_39BBCB1ACB2DEB9E FOREIGN KEY (rayons_magasin_id) REFERENCES rayons_magasin (id)');
        $this->addSql('CREATE INDEX IDX_39BBCB1A9F2C3FAB ON audit_item (zone_id)');
        $this->addSql('CREATE INDEX IDX_39BBCB1ACB2DEB9E ON audit_item (rayons_magasin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit_item DROP FOREIGN KEY FK_39BBCB1A9F2C3FAB');
        $this->addSql('ALTER TABLE audit_item DROP FOREIGN KEY FK_39BBCB1ACB2DEB9E');
        $this->addSql('DROP INDEX IDX_39BBCB1A9F2C3FAB ON audit_item');
        $this->addSql('DROP INDEX IDX_39BBCB1ACB2DEB9E ON audit_item');
        $this->addSql('ALTER TABLE audit_item DROP zone_id, DROP rayons_magasin_id');
    }
}
