<?php

namespace Crocoit\Post\Block\Department;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_postCollection = null;
 
    protected $_department;
 
    protected $_post;

    protected $_resource;

    const LIST_POSTS_ENABLED = 'posts/department/view_list';
 
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Crocoit\Post\Model\Department $department
     * @param \Crocoit\Post\Model\Post $post
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Crocoit\Post\Model\Department $department,
        \Crocoit\Post\Model\Post $post,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_department = $department;
 
        $this->_post = $post;
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
 
        // Get department
        $department = $this->getLoadedDepartment();
 
        // Title is department's name
        $title = $department->getName();
        $description = __('Look at the post we have got for you');
        $keywords = __('post,hiring');
 
        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');
 
        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'posts',
                [
                    'label' => __('We are hiring'),
                    'title' => __('We are hiring'),
                    'link' => $this->getListPostUrl() // No link for the last element
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'post',
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
 
    protected function _getDepartment()
    {
        if (!$this->_department->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->_department = $this->_department->load($entityId);
        }
        return $this->_department;
    }
 
    public function getLoadedDepartment()
    {
        return $this->_getDepartment();
    }
 
    public function getListPostUrl(){
        return $this->getUrl('posts/post');
    }
 
    protected function _getPostCollection(){
        if($this->_postCollection === null && $this->_department->getId()){ 
            $connection = $this->_resource->getConnection(); 

            $query = " SELECT pos.* FROM crocoit_posts pos
                        JOIN crocoit_department_posts ON crocoit_department_posts.department_id  =  "  . $this->_department->getId() . 
                        "
                        AND  pos.entity_id = crocoit_department_posts.post_id";
            $postCollection =  $connection->fetchAll($query); 
            $this->_postCollection  = $postCollection;
        }
        return $this->_postCollection;
    }
 
    public function getLoadedPostsCollection()
    {
        return $this->_getPostCollection();
    }
 
    public function getPostUrl($post){
        if(!$post->getId()){
            return '#';
        }
 
        return $this->getUrl('posts/post/view', ['id' => $post['entity_id']]);
    }

    public function getConfigListPosts() {
        return $this->_scopeConfig->getValue(
            self::LIST_POSTS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}