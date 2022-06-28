<?php
namespace Crocoit\Post\Controller\Post;

use Magento\Framework\App\Action\Context;
use  Crocoit\Post\Model\PostFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_postFactory;

     /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $_logger;

    public function __construct(
        Context $context,  
    ) {
        parent::__construct($context); 
    }
    
    public function execute()
    {
        // $result = $this->_postFactory->create();
        // $collection = $result->getCollection(); //Get collection of blog
        // var_dump(  $collection->joinDepartments()->getData()  );
        // echo '<pre>' . var_export($collection->joinDepartments(), true) . '</pre>';
        // echo '<pre>' . var_export($collection->joinDepartments()->getData()  , true) . '</pre>';
        // die();
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}

