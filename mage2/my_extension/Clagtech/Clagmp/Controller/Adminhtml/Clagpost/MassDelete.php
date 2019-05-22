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
namespace Clagtech\Clagmp\Controller\Adminhtml\Clagpost;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Mass Action Filter
     * 
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;

    /**
     * Collection Factory
     * 
     * @var \Mageplaza\HelloWorld\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * constructor
     * 
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Mageplaza\HelloWorld\Model\ResourceModel\Post\CollectionFactory $collectionFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Clagtech\Clagmp\Model\ClagpostFactory $clagpostFactory,
        \Clagtech\Clagmp\Model\ResourceModel\Clagpost\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {

        $this->_clagpostFactory = $clagpostFactory;

        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }


    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {

         

        $items = $this->_clagpostFactory->create();

        $collection = $items->getCollection();

    
        //$collect = $this->_filter->getCollection($collection);

        $collect = $collection;

      
        var_dump($collect->getData()); 

        die();




        $collection = $this->_filter->getCollection($this->_collectionFactory->create());

        //$collection = $this->_collectionFactory->create();
         var_dump($collection->getData()); die();

        $delete = 0;
        foreach ($collection as $item) {
            /** @var \Mageplaza\HelloWorld\Model\Post $item */
            $item->delete();
            $delete++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
