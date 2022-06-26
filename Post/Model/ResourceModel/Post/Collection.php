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

    public function joinDepartments(){ 
        
        $second_table_name = $this->getTable('crocoit_department_posts');
        $third_table_name = $this->getTable('crocoit_department');
         
        $this->getSelect()->joinRight(array('second' => $second_table_name),
                                               'main_table.entity_id = second.post_id' , 
                                               ['post_entity_id' => 'main_table.entity_id'])
                          ->joinRight(array('third' => $third_table_name),
                                               'second.department_id = third.entity_id' , 
                                               ['post_department_id' => 'third.entity_id']
                                            );
        return $this;  
    }

    public function addQuery($post, $department){ 
        $this->addFieldToSelect('*')
        ->getSelect(); 
        return $this;
    }

}