<?php 

namespace Crocoit\Post\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
 
        // Action to do if module version is less than 1.0.0.0
        if (version_compare($context->getVersion(), '1.0.0.0') < 0) {
 
            /**
             * Create table 'crocoit_posts'
             */
 
            $tableName = $installer->getTable('crocoit_posts');
            $tableComment = 'Post management on Magento 2';
            $columns = array(
                'entity_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
                    'comment' => 'Post Id',
                ),
                'title' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Post Title',
                ),  
                'content' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 2048,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Post description',
                )
            );
 
            $indexes =  array(
                'title',
            );
 
            $foreignKeys = array(
                // No foreign keys for this table
            );
 
            /**
             *  We can use the parameters above to create our table
             */
 
            // Table creation
            $table = $installer->getConnection()->newTable($tableName);
 
            // Columns creation
            foreach($columns AS $name => $values){
                $table->addColumn(
                    $name,
                    $values['type'],
                    $values['size'],
                    $values['options'],
                    $values['comment']
                );
            }
 
            // Indexes creation
            foreach($indexes AS $index){
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }
 
            // Foreign keys creation
            foreach($foreignKeys AS $column => $foreignKey){
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }
 
            // Table comment
            $table->setComment($tableComment);
 
            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);
        }


        // Action to do if module version is less than 1.0.0.2
        if (version_compare($context->getVersion(), '1.0.0.2') < 0) {
 
            /**
             * Create table 'crocoit_department_posts'
             */
 
            $tableName = $installer->getTable('crocoit_department_posts');
            $tableComment = 'Department Posts  on Magento 2';
            $columns = array(
                'entity_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
                    'comment' => 'Id',
                ),
                'post_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('unsigned' => true, 'nullable' => false ,'primary' => true),
                    'comment' => 'Post id',
                ),  
                'department_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' =>array('unsigned' => true, 'nullable' => false ,'primary' => true),
                    'comment' => 'Department id',
                ),  
            );
 
            $indexes =  array(
                'department_id','post_id'
            );
 
            $foreignKeys = array(
                'department_id' => array(
                    'ref_table' => 'crocoit_department',
                    'ref_column' => 'entity_id',
                    'on_delete' => Table::ACTION_CASCADE,
                ),
                'post_id' => array(
                    'ref_table' => 'crocoit_posts',
                    'ref_column' => 'entity_id',
                    'on_delete' => Table::ACTION_CASCADE,
                )
            );
 
            /**
             *  We can use the parameters above to create our table
             */
 
            // Table creation
            $table = $installer->getConnection()->newTable($tableName);
 
            // Columns creation
            foreach($columns AS $name => $values){
                $table->addColumn(
                    $name,
                    $values['type'],
                    $values['size'],
                    $values['options'],
                    $values['comment']
                );
            }
 
            // Indexes creation
            foreach($indexes AS $index){
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }
 
            // Foreign keys creation
            foreach($foreignKeys AS $column => $foreignKey){
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }
 
            // Table comment
            $table->setComment($tableComment);
 
            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);
        }

        if (version_compare($context->getVersion(), '1.0.0.5') < 0) {
 
            /**
             * Add full text index to our table department
             */
 
            $tableName = $installer->getTable('crocoit_department');
            $fullTextIntex = array('name'); // Column with fulltext index, you can put multiple fields
 
 
            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
 
            /**
             * Add full text index to our table post
             */
 
            $tableName = $installer->getTable('crocoit_posts');
            $fullTextIntex = array('title'); // Column with fulltext index, you can put multiple fields
 
 
            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
 
        }
        
 
        $installer->endSetup();
    }
}