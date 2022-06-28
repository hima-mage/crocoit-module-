<?php
namespace Crocoit\Post\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const LIST_POSTS_ENABLED = 'posts/department/view_list';
 
    /**
     * Return if display list is enabled on department view
     * @return bool
     */
    public function getListPostEnabled() {
        return $this->scopeConfig->getValue(
            self::LIST_POSTS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}