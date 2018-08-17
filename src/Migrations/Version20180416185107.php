<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416185107 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rayons_magasin DROP FOREIGN KEY FK_30D57E8F62C7ADD3');
        $this->addSql('ALTER TABLE rayons_magasin DROP FOREIGN KEY FK_30D57E8FDE52078D');
        $this->addSql('DROP INDEX IDX_30D57E8FDE52078D ON rayons_magasin');
        $this->addSql('DROP INDEX IDX_30D57E8F62C7ADD3 ON rayons_magasin');
        $this->addSql('ALTER TABLE rayons_magasin ADD magasin_id INT NOT NULL, ADD rayon_id INT NOT NULL, DROP magasins_id, DROP rayons_id');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8F20096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8FD3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('CREATE INDEX IDX_30D57E8F20096AE3 ON rayons_magasin (magasin_id)');
        $this->addSql('CREATE INDEX IDX_30D57E8FD3202E52 ON rayons_magasin (rayon_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rayons_magasin DROP FOREIGN KEY FK_30D57E8F20096AE3');
        $this->addSql('ALTER TABLE rayons_magasin DROP FOREIGN KEY FK_30D57E8FD3202E52');
        $this->addSql('DROP INDEX IDX_30D57E8F20096AE3 ON rayons_magasin');
        $this->addSql('DROP INDEX IDX_30D57E8FD3202E52 ON rayons_magasin');
        $this->addSql('ALTER TABLE rayons_magasin ADD magasins_id INT NOT NULL, ADD rayons_id INT NOT NULL, DROP magasin_id, DROP rayon_id');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8F62C7ADD3 FOREIGN KEY (rayons_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8FDE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_30D57E8FDE52078D ON rayons_magasin (magasins_id)');
        $this->addSql('CREATE INDEX IDX_30D57E8F62C7ADD3 ON rayons_magasin (rayons_id)');
    }
}
