<?php

namespace Crocoit\Post\Controller\Cookie;

class Testaddcookie extends \Magento\Framework\App\Action\Action
{
    const Post_COOKIE_NAME = 'posts';
    const Post_COOKIE_DURATION = 86400; // lifetime in seconds
 
    /**
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $_cookieManager;
 
    /**
     * @var \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
     */
    protected $_cookieMetadataFactory;
 
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
    )
    {
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $metadata = $this->_cookieMetadataFactory
            ->createPublicCookieMetadata()
            ->setDuration(self::Post_COOKIE_DURATION);
 
        $this->_cookieManager->setPublicCookie(
            self::Post_COOKIE_NAME,
            'MY COOKIE VALUE',
            $metadata
        );
 
        echo('COOKIE OK');
    }
}