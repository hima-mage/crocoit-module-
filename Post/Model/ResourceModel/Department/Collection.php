<?php
namespace  Crocoit\Post\Model\ResourceModel\Department;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \Crocoit\Post\Model\Department::DEPARTMENT_ID;
     
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Crocoit\Post\Model\Department', 'Crocoit\Post\Model\ResourceModel\Department');
    }
 
}