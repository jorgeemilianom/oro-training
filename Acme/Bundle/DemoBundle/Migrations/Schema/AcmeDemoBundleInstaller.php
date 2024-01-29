<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AcmeDemoBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_2';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createCustomTableForTestTable($schema);
        $this->addDescriptionField($schema);
    }

    /**
     * Create custom_table_for_test table
     *
     * @param Schema $schema
     */
    protected function createCustomTableForTestTable(Schema $schema)
    {
        $table = $schema->createTable('custom_table_for_test');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 250]);
        $table->addColumn('type', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    protected function addDescriptionField(Schema $schema)
    {
        $table = $schema->getTable('custom_table_for_test');
        if(!$table->hasColumn('description')) {
            $table->addColumn('description', 'string', ['notnull' => false, 'length' => 200]);
        }

    }

}