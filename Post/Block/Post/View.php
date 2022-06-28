<?php
namespace Crocoit\Post\Block\post;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_post;
 
    protected $_department;
 
    protected $_resource;
    

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Crocoit\Post\Model\Post $post
     * @param \Crocoit\Post\Model\Department $department
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Crocoit\Post\Model\Post $post,
        \Crocoit\Post\Model\Department $department,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_post = $post;
        $this->_department = $department;
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
 
        // Get post and department
        $post = $this->getLoadedpost();
        $department = $this->getLoadedDepartment();
 
        // Title is post's title and department's name
        $title = $post->getTitle()  ;
        $description = __('Look at the Post we have got for you');
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
 
    protected function _getPost()
    {
        if (!$this->_post->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->_post = $this->_post->load($entityId);
        }
        return $this->_post;
    }
 
 
    public function getLoadedPost()
    {
        return $this->_getPost();
    }
 
    protected function _getDepartment()
    {
        $connection = $this->_resource->getConnection(); 

        $query = " SELECT cd.* FROM crocoit_department cd
                    JOIN crocoit_department_posts ON crocoit_department_posts.post_id  =  "  . $this->_post->getId() . 
                    "
                    AND  cd.entity_id = crocoit_department_posts.department_id";
        return $connection->fetchAll($query); 
    }
 
 
    public function getLoadedDepartment()
    {
        return $this->_getDepartment();
    }
 
 
    public function getListpostUrl(){
        return $this->getUrl('posts/post');
    }
 
    public function getDepartmentUrl($department){
        if(!$department['entity_id']){
            return '#';
        }
 
        return $this->getUrl('posts/department/view', ['id' => $department['entity_id'] ]);
    }
}