<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210605105118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE list_category (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, emploi_id INT DEFAULT NULL, immo_id INT DEFAULT NULL, automobile_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_78212AA14B89032C (post_id), UNIQUE INDEX UNIQ_78212AA1EC013E12 (emploi_id), UNIQUE INDEX UNIQ_78212AA1ACCF8247 (immo_id), UNIQUE INDEX UNIQ_78212AA150E09BD4 (automobile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE list_category ADD CONSTRAINT FK_78212AA14B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE list_category ADD CONSTRAINT FK_78212AA1EC013E12 FOREIGN KEY (emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE list_category ADD CONSTRAINT FK_78212AA1ACCF8247 FOREIGN KEY (immo_id) REFERENCES immo (id)');
        $this->addSql('ALTER TABLE list_category ADD CONSTRAINT FK_78212AA150E09BD4 FOREIGN KEY (automobile_id) REFERENCES automobile (id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D3256915B');
        $this->addSql('DROP INDEX IDX_5A8A6C8D3256915B ON post');
        $this->addSql('ALTER TABLE post CHANGE relation_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE list_category');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA76ED395 ON post');
        $this->addSql('ALTER TABLE post CHANGE user_id relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D3256915B ON post (relation_id)');
    }
}
