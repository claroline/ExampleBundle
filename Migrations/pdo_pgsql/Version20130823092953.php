<?php

namespace Claroline\ExampleBundle\Migrations\pdo_pgsql;

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
            ADD resourceNode_id INT DEFAULT NULL
        ");
        $this->addSql("
            CREATE SEQUENCE claro_example_id_seq
        ");
        $this->addSql("
            SELECT setval(
                'claro_example_id_seq', 
                (
                    SELECT MAX(id) 
                    FROM claro_example
                )
            )
        ");
        $this->addSql("
            ALTER TABLE claro_example ALTER id 
            SET 
                DEFAULT nextval('claro_example_id_seq')
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            DROP CONSTRAINT FK_EAF2638BF396750
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            ADD CONSTRAINT FK_EAF2638B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_EAF2638B87FAB32 ON claro_example (resourceNode_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_example 
            DROP resourceNode_id
        ");
        $this->addSql("
            ALTER TABLE claro_example ALTER id 
            DROP DEFAULT
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            DROP CONSTRAINT FK_EAF2638B87FAB32
        ");
        $this->addSql("
            DROP INDEX UNIQ_EAF2638B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_example 
            ADD CONSTRAINT FK_EAF2638BF396750 FOREIGN KEY (id) 
            REFERENCES claro_resource (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
    }
}