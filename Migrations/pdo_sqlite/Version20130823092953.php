<?php

namespace Claroline\ExampleBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/08/23 09:29:54
 */
class Version20130823092953 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_example AS 
            SELECT id, 
            text 
            FROM claro_example
        ");
        $this->addSql("
            DROP TABLE claro_example
        ");
        $this->addSql("
            CREATE TABLE claro_example (
                id INTEGER NOT NULL, 
                text VARCHAR(255) NOT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_EAF2638B87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_example (id, text) 
            SELECT id, 
            text 
            FROM __temp__claro_example
        ");
        $this->addSql("
            DROP TABLE __temp__claro_example
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_EAF2638B87FAB32 ON claro_example (resourceNode_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_EAF2638B87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_example AS 
            SELECT id, 
            text 
            FROM claro_example
        ");
        $this->addSql("
            DROP TABLE claro_example
        ");
        $this->addSql("
            CREATE TABLE claro_example (
                id INTEGER NOT NULL, 
                text VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_EAF2638BF396750 FOREIGN KEY (id) 
                REFERENCES claro_resource (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_example (id, text) 
            SELECT id, 
            text 
            FROM __temp__claro_example
        ");
        $this->addSql("
            DROP TABLE __temp__claro_example
        ");
    }
}