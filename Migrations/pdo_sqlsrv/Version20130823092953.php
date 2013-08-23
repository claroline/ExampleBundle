<?php

namespace Claroline\ExampleBundle\Migrations\pdo_sqlsrv;

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
            ALTER TABLE claro_example 
            ADD resourceNode_id INT
        ");
        $this->addSql("
            ALTER TABLE claro_example ALTER COLUMN id INT IDENTITY NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            DROP CONSTRAINT FK_EAF2638BF396750
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            ADD CONSTRAINT FK_EAF2638B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_EAF2638B87FAB32 ON claro_example (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_example 
            DROP COLUMN resourceNode_id
        ");
        $this->addSql("
            ALTER TABLE claro_example ALTER COLUMN id INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            DROP CONSTRAINT FK_EAF2638B87FAB32
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_EAF2638B87FAB32'
            ) 
            ALTER TABLE claro_example 
            DROP CONSTRAINT UNIQ_EAF2638B87FAB32 ELSE 
            DROP INDEX UNIQ_EAF2638B87FAB32 ON claro_example
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            ADD CONSTRAINT FK_EAF2638BF396750 FOREIGN KEY (id) 
            REFERENCES claro_resource (id) 
            ON DELETE CASCADE
        ");
    }
}