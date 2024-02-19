<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219110748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album_artist DROP FOREIGN KEY FK_D322AB301137ABCF');
        $this->addSql('ALTER TABLE album_artist DROP FOREIGN KEY FK_D322AB30B7970CF8');
        $this->addSql('DROP TABLE album_artist');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_artist (album_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_D322AB301137ABCF (album_id), INDEX IDX_D322AB30B7970CF8 (artist_id), PRIMARY KEY(album_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE album_artist ADD CONSTRAINT FK_D322AB301137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artist ADD CONSTRAINT FK_D322AB30B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
    }
}
