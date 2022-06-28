<?php
 
 
namespace Crocoit\Post\Logger;
 
class Logger extends \Monolog\Logger
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
    protected $fileName = '/var/log/crocoit_posts.log';

}