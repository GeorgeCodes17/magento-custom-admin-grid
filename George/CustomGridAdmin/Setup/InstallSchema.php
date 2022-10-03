<?php

namespace George\CustomGridAdmin\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
        $tableName = "george_customgrid_items";
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists($tableName)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'ID'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                40,
                ['nullable' => false],
                'Title'
            )->addColumn(
                'path_to_image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                ['nullable' => true],
                'Path To Item Image'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '2M',
                [],
                'Description'
            )->addColumn(
                'key_features',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Key Features of the Item'
            )->setComment("Custom Grid Items Table");
            $installer->getConnection()->createTable($table);



            $installer->getConnection()->addIndex(
                $installer->getTable($tableName), 
                $installer->getConnection()->getIndexName(
                    $installer->getTable($tableName),
                    'id'
                ),
                ['id'],
            );
            $installer->getConnection()->addIndex(
                $installer->getTable($tableName), 
                $installer->getConnection()->getIndexName(
                    $installer->getTable($tableName),
                    'title'
                ),
                ['title'],
            );
            $installer->getConnection()->addIndex(
                $installer->getTable($tableName), 
                $installer->getConnection()->getIndexName(
                    $installer->getTable($tableName),
                    'path_to_image'
                ),
                ['path_to_image'],
            );
            $installer->getConnection()->addIndex(
                $installer->getTable($tableName), 
                $installer->getConnection()->getIndexName(
                    $installer->getTable($tableName),
                    'description'
                ),
                ['description'],
            );
            $installer->getConnection()->addIndex(
                $installer->getTable($tableName), 
                $installer->getConnection()->getIndexName(
                    $installer->getTable($tableName),
                    'key_features'
                ),
                ['key_features'],
            );
        }
        $installer->endSetup();
	}
}
