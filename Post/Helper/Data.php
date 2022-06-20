<?php
namespace Crocoit\Post\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;
class Data extends AbstractHelper
{
    protected $resourceConnection;
    public function __construct(Context $context, ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
        parent::__construct($context);
    }
    public function runSqlQuery($table)
    {
        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName('my_custom_table');
        //For Select query
        $query = "Select * FROM " . $table;
        $result = $connection->fetchAll($query);
        $this->_logger->log(print_r($result, true));

        
        $id = 2;
        $query = "SELECT * FROM `" . $table . "` WHERE id = $id ";
        $result1 = $connection->fetchAll($query);
        $this->_logger->log(print_r($result1, true));
         
    }
}