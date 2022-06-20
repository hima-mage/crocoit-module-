<?php
namespace Crocoit\Post\Block\Post;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;
class ListPost extends \Magento\Framework\View\Element\Template
{
 
    protected $_post;
 
    protected $_department;

    protected $_departmentPosts;
 
    protected $_resource;
 
    protected $_postCollection = null;

    protected $_departmentCollection = null;

    protected $_departmentPostsCollection = null;
     

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Crocoit\Post\Model\Post $post
     * @param \Crocoit\Post\Model\Department $department
     * @param \Crocoit\Post\Model\DepartmentPosts $departmentPosts
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Crocoit\Post\Model\Post $post,
        \Crocoit\Post\Model\Department $department,
        \Crocoit\Post\Model\DepartmentPosts $departmentPosts,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_post = $post;
        $this->_department = $department;
        $this->_departmentPosts = $departmentPosts;
        $this->_resource = $resource;
 
        parent::__construct(
            $context,
            $data
        );
    }
 
    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
 
 
        // You can put these informations editable on BO
        $title = __('Some Posts');
        $description = __('Look at the posts we have got for you');
        $keywords = __('post,articale');
 
        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');
 
        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'posts',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }
 
        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);
 
 
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }
 
        return $this;
    }
 
    protected function _getPostCollection()
    {

        if ($this->_postCollection === null) {
 
            $postCollection = $this->_post->getCollection()->addQuery($this->_post, $this->_department);
 
            $this->_postCollection = $postCollection;
        }
        return $this->_postCollection;

         
    }

    // public function _getDepartmentPostsCollection()
    // {
    //     // return 1;

    //     if ($this->_departmentPostsCollection === null) {
 
    //         $departmentPostsCollection = $this->_departmentPosts->getCollection()->joinQueryRelation();
 
    //         $this->_departmentPostsCollection = $departmentPostsCollection;
    //     }
    //     return $this->_departmentPostsCollection;
         
    // }

    public function _getDepartmentCollection($post)
    {
        $connection = $this->_resource->getConnection(); 

        $query = " SELECT cd.* FROM crocoit_department cd
                    JOIN crocoit_department_posts ON crocoit_department_posts.post_id  =  "  . $post->getId() . 
                    "
                    AND  cd.entity_id = crocoit_department_posts.department_id";
        return $connection->fetchAll($query); 
    }
 
 
    public function getLoadedPostCollection()
    {
        return $this->_getPostCollection();
    }
 
    public function getPostUrl($post){
        if(!$post->getId()){
            return '#';
        }
 
        return $this->getUrl('posts/post/view', ['id' => $post->getId()]);
    }
 
    public function getDepartmentUrl($department){
        if(!$department['entity_id']){
            return '#';
        }
 
        return $this->getUrl('posts/department/view', ['id' => $department['entity_id'] ]);
    }
}