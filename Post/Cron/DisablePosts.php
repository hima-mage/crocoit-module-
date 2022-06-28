<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Crocoit\Post\Cron;
 
class DisablePosts
{
    /**
     * @var \Crocoit\Post\Model\Post
     */
    protected $_post;
 
    /**
     * @param \Crocoit\Post\Model\Post $post
     */
    public function __construct(
        \Crocoit\Post\Model\Post $post
    ) {
        $this->_post = $post;
    }
 
    /**
     * Disable jobs which date is less than the current date
     *
     * @param \Magento\Cron\Model\Schedule $schedule
     * @return void
     */
    public function execute(\Magento\Cron\Model\Schedule $schedule)
    {
        $nowDate = date('Y-m-d');
        $postsCollection = $this->_post->getCollection()
            ->addFieldToFilter('date', array ('lt' => $nowDate));
 
        foreach($postsCollection AS $post) {
            $post->setStatus($post->getDisableStatus());
            $post->save();
        }
    }
}