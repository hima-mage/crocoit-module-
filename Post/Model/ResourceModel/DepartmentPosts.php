<?php
namespace  Crocoit\Post\Model\ResourceModel;
 
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
/**
 * DepartmentPosts  mysql resource
 */
class DepartmentPosts extends AbstractDb
{
 
    /**
    * Construct
    *
    * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
    * @param string $connectionName
    */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $connectionName = null
    )  {
        parent::__construct($context, $connectionName);
    }

    /**
    * Initialize resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('crocoit_department_posts', 'entity_id');
    }

    /**
    * Load an object using 'identifier' field if there's no field specified and value is not numeric
    *
    * @param \Magento\Framework\Model\AbstractModel $object
    * @param mixed $value
    * @param string $field
    * @return $this
    */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
        $field = 'identifier';
        }

        return parent::load($object, $value, $field);
    }
 
    /**
     * Retrieve post department Ids
     *
     * @param array $postIds
     * @return array
     */
    public function getDepartments(array $postIds)
    {
        $select = $this->getConnection()->select()->from(
            $this->getMainTable(),
            ['post_id', 'department_id ']
        )->where(
            'post_id IN (?)',
            $postIds
        );
        $rowset = $this->getConnection()->fetchAll($select);

        $result = [];
        foreach ($rowset as $row) {
            $result[$row['post_id']][] = $row['department_id '];
        }

        return $result;
    }


    /**
     * Retrieve category post Ids
     *
     * @param array $departmentIds
     * @return array
     */
    public function getPosts(array $departmentIds)
    {
        $select = $this->getConnection()->select()->from(
            $this->getMainTable(),
            ['post_id', 'department_id']
        )->where(
            'department_id IN (?)',
            $departmentIds
        );
        $rowset = $this->getConnection()->fetchAll($select);

        $result = [];
        foreach ($rowset as $row) {
            $result[$row['post_id']][] = $row['department_id'];
        }

        return $result;
    }
}