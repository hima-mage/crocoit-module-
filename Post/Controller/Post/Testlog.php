<?php

namespace Crocoit\Post\Controller\Post;
 
class Testlog extends \Magento\Framework\App\Action\Action
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $_logger;
 
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \PCrocoit\Post\Logger\Logger $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Crocoit\Post\Logger\Logger $logger
    )
    {
        $this->_logger = $logger;
        parent::__construct($context);
    }
 
    public function execute()
    {
        // $this->_logger->debug('My debug log');
        // $this->_logger->info('My info log');
        // $this->_logger->notice('My notice log');
        // $this->_logger->addWarning('My warning log');
        // $this->_logger->addError('My error log');
        // $this->_logger->addCritical('My critical log');
        // $this->_logger->addAlert('My alert log');
        // $this->_logger->addEmergency('My emergency log');
 
        $this->_logger->debug('Error message', ['exception' => 'e']);
        $this->_logger->info('Error message', ['exception' => 'e']);

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}