<?php
namespace  Crocoit\Post\Model\ResourceModel;
 
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
/**
 *  post mysql resource
 */
class Post extends AbstractDb
{
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('crocoit_posts', 'entity_id');
    }

     
 
}