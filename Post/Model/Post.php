<?php
namespace  Crocoit\Post\Model;
 
use \Magento\Framework\Model\AbstractModel;
 
class Post extends AbstractModel
{
    const Post_ID = 'entity_id'; // We define the id fieldname
 
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'post';
 
    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'post';
 
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::Post_ID;
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Crocoit\Post\Model\ResourceModel\Post');
    }

    public function getEnableStatus() {
        return 1;
    }
     
    public function getDisableStatus() {
        return 0;
    }

    
}