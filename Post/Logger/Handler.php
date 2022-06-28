<?php
namespace Crocoit\Post\Logger;
 
use Monolog\Logger;
 
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::DEBUG;
 
    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/crocoit_post.log';
}