<?php
/**
* Join table data interface
*/

namespace Crocoit\Post\Api\Data;

/**
* Post JoinModel interface.
*
* @api
*/
interface DepartmentPostsInterface
{
    /**#@+
    * Constants for keys of data array. Identical to the name of the getter in snake case
    */
    const ENTITY_ID = 'entity_id';
    /**#@-*/

    /**
    * Get ID.
    *
    * @return int|null
    */
    public function getId();

    /**
    * Set ID.
    *
    * @param int $id
    *
    * @return \Crocoit\Post\Api\Data\ReasonsInterface
    */
    public function setId($id);
}