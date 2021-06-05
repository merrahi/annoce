<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604212929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE automobile ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE automobile ADD CONSTRAINT FK_BFCEA08712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_BFCEA08712469DE2 ON automobile (category_id)');
        $this->addSql('ALTER TABLE emploi ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_74A0B0FA12469DE2 ON emploi (category_id)');
        $this->addSql('ALTER TABLE immo ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE immo ADD CONSTRAINT FK_2A3B56C512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2A3B56C512469DE2 ON immo (category_id)');
        $this->addSql('ALTER TABLE post ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D3256915B ON post (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE automobile DROP FOREIGN KEY FK_BFCEA08712469DE2');
        $this->addSql('DROP INDEX IDX_BFCEA08712469DE2 ON automobile');
        $this->addSql('ALTER TABLE automobile DROP category_id');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA12469DE2');
        $this->addSql('DROP INDEX IDX_74A0B0FA12469DE2 ON emploi');
        $this->addSql('ALTER TABLE emploi DROP category_id');
        $this->addSql('ALTER TABLE immo DROP FOREIGN KEY FK_2A3B56C512469DE2');
        $this->addSql('DROP INDEX IDX_2A3B56C512469DE2 ON immo');
        $this->addSql('ALTER TABLE immo DROP category_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D3256915B');
        $this->addSql('DROP INDEX IDX_5A8A6C8D3256915B ON post');
        $this->addSql('ALTER TABLE post DROP relation_id');
    }
}
