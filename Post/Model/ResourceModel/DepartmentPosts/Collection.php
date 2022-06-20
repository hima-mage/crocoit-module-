<?php
/**
* join model collection
*/

namespace Crocoit\Post\Model\ResourceModel\DepartmentPosts;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
* Crocoit Post ResourceModel DepartmentPosts collection
*/
class Collection extends AbstractCollection
{
/**
* @var string
*/
protected $_idFieldName = 'entity_id';

/**
* Store manager
*
* @var \Magento\Store\Model\StoreManagerInterface
*/
protected $_storeManager;

/**
* @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
* @param \Psr\Log\LoggerInterface $logger
* @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
* @param \Magento\Framework\Event\ManagerInterface $eventManager
* @param \Magento\Store\Model\StoreManagerInterface $storeManager
* @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
* @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
*/
public function __construct(
    \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
    \Psr\Log\LoggerInterface $logger,
    \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
    \Magento\Framework\Event\ManagerInterface $eventManager,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
)
{
    parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    $this->_storeManager = $storeManager;
}

    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('Crocoit\Post\Model\DepartmentPosts', 'Crocoit\Post\Model\ResourceModel\DepartmentPosts');
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }

    public function joinQueryRelation() { 
        /**
         * $departmentTable name of order table
         */
        $departmentTable = 'crocoit_department';  ;
        
        /**
         * $postTable name of customer table
         */
        $postTable ='crocoit_posts';

        /**
         * $joinCollection 
         * @var Crocoit\Post\Model\ResourceModel\DepartmentPosts\CollectionFactory
         */ 
        $joinCollection = 
            $this->join(
                ['dep' => $departmentTable],
                "main_table.department_id = dep.entity_id"
            )->join(
                ['post' => $postTable],
                "main_table.post_id = post.entity_id"
            );
        
        $joinCollection->getSelect();
        
        return $this;
    }

     
}