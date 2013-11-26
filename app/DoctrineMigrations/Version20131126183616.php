<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131126183616 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE blog_tags (blog_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_8F6C18B6DAE07E97 (blog_id), INDEX IDX_8F6C18B6BAD26311 (tag_id), PRIMARY KEY(blog_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE blog_tags ADD CONSTRAINT FK_8F6C18B6DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)");
        $this->addSql("ALTER TABLE blog_tags ADD CONSTRAINT FK_8F6C18B6BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)");
        $this->addSql("ALTER TABLE blog ADD category_id INT DEFAULT NULL, DROP tags");
        $this->addSql("ALTER TABLE blog ADD CONSTRAINT FK_C015514312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)");
        $this->addSql("CREATE INDEX IDX_C015514312469DE2 ON blog (category_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE blog DROP FOREIGN KEY FK_C015514312469DE2");
        $this->addSql("ALTER TABLE blog_tags DROP FOREIGN KEY FK_8F6C18B6BAD26311");
        $this->addSql("DROP TABLE blog_tags");
        $this->addSql("DROP TABLE category");
        $this->addSql("DROP TABLE tag");
        $this->addSql("DROP INDEX IDX_C015514312469DE2 ON blog");
        $this->addSql("ALTER TABLE blog ADD tags LONGTEXT NOT NULL, DROP category_id");
    }
}
