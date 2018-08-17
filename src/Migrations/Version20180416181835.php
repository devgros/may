<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416181835 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rayons_magasin (id INT AUTO_INCREMENT NOT NULL, magasins_id INT NOT NULL, rayons_id INT NOT NULL, INDEX IDX_30D57E8FDE52078D (magasins_id), INDEX IDX_30D57E8F62C7ADD3 (rayons_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayons_magasin_zone (rayons_magasin_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_119C81D8CB2DEB9E (rayons_magasin_id), INDEX IDX_119C81D89F2C3FAB (zone_id), PRIMARY KEY(rayons_magasin_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8FDE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE rayons_magasin ADD CONSTRAINT FK_30D57E8F62C7ADD3 FOREIGN KEY (rayons_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE rayons_magasin_zone ADD CONSTRAINT FK_119C81D8CB2DEB9E FOREIGN KEY (rayons_magasin_id) REFERENCES rayons_magasin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rayons_magasin_zone ADD CONSTRAINT FK_119C81D89F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rayons_magasin_zone DROP FOREIGN KEY FK_119C81D8CB2DEB9E');
        $this->addSql('DROP TABLE rayons_magasin');
        $this->addSql('DROP TABLE rayons_magasin_zone');
    }
}
