<?php
namespace Crocoit\Post\Block\Adminhtml\Post;
 
use Magento\Backend\Block\Widget\Form\Container;
 
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
 
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    /**
     * Department edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Crocoit_Post';
        $this->_controller = 'adminhtml_post';
 
        parent::_construct();
 
        if ($this->_isAllowedAction('Crocoit_Post::post_save')) {
            $this->buttonList->update('save', 'label', __('Save Post'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
 
    }
 
    /**
     * Get header with Department name
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('posts_post')->getId()) {
            return __("Edit Post '%1'", $this->escapeHtml($this->_coreRegistry->registry('posts_post')->getName()));
        } else {
            return __('New Post');
        }
    }
 
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
 
    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('posts/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}