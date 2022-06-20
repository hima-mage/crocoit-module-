<?php
namespace  Crocoit\Post\Model\ResourceModel\Post;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \Crocoit\Post\Model\Post::Post_ID;
     
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Crocoit\Post\Model\Post', 'Crocoit\Post\Model\ResourceModel\Post');
    }


    public function addQuery($post, $department){
        
        $this->addFieldToSelect('*')
        ->getSelect(); 
        return $this;
    }

}