<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131127114521 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE category ADD slug VARCHAR(255) NOT NULL, ADD `default` TINYINT(1) NOT NULL, CHANGE category name VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE tag ADD slug VARCHAR(255) NOT NULL, ADD weight INT NOT NULL, CHANGE tag name VARCHAR(255) NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE category ADD category VARCHAR(255) NOT NULL, DROP name, DROP slug, DROP `default`");
        $this->addSql("ALTER TABLE tag ADD tag VARCHAR(255) NOT NULL, DROP name, DROP slug, DROP weight");
    }
}
