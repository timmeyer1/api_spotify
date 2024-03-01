<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301081248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_user (album_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E99860091137ABCF (album_id), INDEX IDX_E9986009A76ED395 (user_id), PRIMARY KEY(album_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_user ADD CONSTRAINT FK_E99860091137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_user ADD CONSTRAINT FK_E9986009A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_genre DROP FOREIGN KEY FK_F5E879DE1137ABCF');
        $this->addSql('ALTER TABLE album_genre DROP FOREIGN KEY FK_F5E879DE4296D31F');
        $this->addSql('DROP TABLE album_genre');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE album ADD genre_id INT DEFAULT NULL, DROP is_active, CHANGE artist_id artist_id INT DEFAULT NULL, CHANGE image_path image_path VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E434296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_39986E434296D31F ON album (genre_id)');
        $this->addSql('ALTER TABLE artist DROP image_path, CHANGE biography biography VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song CHANGE album_id album_id INT DEFAULT NULL, CHANGE duration duration INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_genre (album_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F5E879DE4296D31F (genre_id), INDEX IDX_F5E879DE1137ABCF (album_id), PRIMARY KEY(album_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE album_genre ADD CONSTRAINT FK_F5E879DE1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_genre ADD CONSTRAINT FK_F5E879DE4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_user DROP FOREIGN KEY FK_E99860091137ABCF');
        $this->addSql('ALTER TABLE album_user DROP FOREIGN KEY FK_E9986009A76ED395');
        $this->addSql('DROP TABLE album_user');
        $this->addSql('DROP TABLE preference');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E434296D31F');
        $this->addSql('DROP INDEX IDX_39986E434296D31F ON album');
        $this->addSql('ALTER TABLE album ADD is_active TINYINT(1) DEFAULT NULL, DROP genre_id, CHANGE artist_id artist_id INT NOT NULL, CHANGE image_path image_path VARCHAR(255) NOT NULL, CHANGE created_at created_at INT NOT NULL, CHANGE updated_at updated_at INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artist ADD image_path VARCHAR(255) DEFAULT NULL, CHANGE biography biography LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE song CHANGE album_id album_id INT NOT NULL, CHANGE duration duration INT NOT NULL');
    }
}
