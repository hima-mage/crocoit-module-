<?php

namespace Crocoit\Post\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class DepartmentPosts  extends \Magento\Framework\Model\AbstractModel implements \Crocoit\Post\Api\Data\DepartmentPostsInterface, IdentityInterface
{

    /**
    * Crocoit DepartmentPosts cache tag.
    */
    const CACHE_TAG = 'crocoit_department_posts';

    protected function _construct()
    {
        $this->_init('Crocoit\Post\Model\ResourceModel\DepartmentPosts'); 

    }

    /**
    * Get identities.
    *
    * @return array
    */
    public function getIdentities()
    {
     return [self::CACHE_TAG.'_'.$this->getId()];
    }

/**
 * @param array $postIds
 */
public function getDepartments($postIds)
{
    return $this->_getResource()->getDepartments($postIds);
}

/**
 * @param array $departmentIds
 */
public function getPosts($departmentIds)
{
    return $this->_getResource()->getPosts($departmentIds);
}

    /**
    * Get ID.
    *
    * @return int
    */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
    * Set ID.
    *
    * @param int $id
    *
    * @return \Webkul\Stripe\Api\Data\JoinModelInterface
    */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

}