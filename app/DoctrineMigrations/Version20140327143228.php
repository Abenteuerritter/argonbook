<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140327143228 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("ALTER TABLE pj ADD story_confirmed_at DATETIME DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("ALTER TABLE pj DROP story_confirmed_at");
    }
}