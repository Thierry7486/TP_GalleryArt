<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927091807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, firstname VARCHAR(64) NOT NULL, nationality VARCHAR(64) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, user_id INT DEFAULT NULL, piece_of_art_id INT DEFAULT NULL, initial_price INT NOT NULL, bidding_level INT NOT NULL, current_price INT DEFAULT NULL, date DATETIME DEFAULT NULL, INDEX IDX_DEE4F59371F7E88B (event_id), INDEX IDX_DEE4F593A76ED395 (user_id), INDEX IDX_DEE4F593ABACA386 (piece_of_art_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_piece_of_art (event_id INT NOT NULL, piece_of_art_id INT NOT NULL, INDEX IDX_F9698FD171F7E88B (event_id), INDEX IDX_F9698FD1ABACA386 (piece_of_art_id), PRIMARY KEY(event_id, piece_of_art_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_of_art (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_147A8522B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(64) NOT NULL, firstname VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F59371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F593A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F593ABACA386 FOREIGN KEY (piece_of_art_id) REFERENCES piece_of_art (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_piece_of_art ADD CONSTRAINT FK_F9698FD171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_piece_of_art ADD CONSTRAINT FK_F9698FD1ABACA386 FOREIGN KEY (piece_of_art_id) REFERENCES piece_of_art (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_of_art ADD CONSTRAINT FK_147A8522B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_of_art DROP FOREIGN KEY FK_147A8522B7970CF8');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F59371F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_piece_of_art DROP FOREIGN KEY FK_F9698FD171F7E88B');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F593ABACA386');
        $this->addSql('ALTER TABLE event_piece_of_art DROP FOREIGN KEY FK_F9698FD1ABACA386');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F593A76ED395');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE auction');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_piece_of_art');
        $this->addSql('DROP TABLE piece_of_art');
        $this->addSql('DROP TABLE `user`');
    }
}
