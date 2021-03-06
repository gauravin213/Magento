<?php
/**
 * Mageplaza_HelloWorld extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Mageplaza License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.mageplaza.com/LICENSE.txt
 * 
 *                     @category  Mageplaza
 *                     @package   Mageplaza_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.mageplaza.com/LICENSE.txt
 */
namespace Clagtech\Clagmp\Controller\Adminhtml;

abstract class Clagpost extends \Magento\Backend\App\Action
{
    /**
     * Post Factory
     * 
     * @var \Mageplaza\HelloWorld\Model\PostFactory
     */
    protected $_postFactory;

    /**
     * Core registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Result redirect factory
     * 
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * constructor
     * 
     * @param \Mageplaza\HelloWorld\Model\PostFactory $postFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Clagtech\Clagmp\Model\ClagpostFactory $clagpostFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_clagpostFactory           = $clagpostFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Init Post
     *
     * @return \Mageplaza\HelloWorld\Model\Post
     */
    protected function _initPost()
    {
        $postId  = (int) $this->getRequest()->getParam('id');
        /** @var \Mageplaza\HelloWorld\Model\Post $post */
        $post    = $this->_clagpostFactory->create();
        if ($postId) {
            $post->load($postId);
        }
        $this->_coreRegistry->register('clagtech_clagmp_clagpost', $post);
        return $post;
    }
}
