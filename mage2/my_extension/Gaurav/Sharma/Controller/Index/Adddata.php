<?php

namespace Gaurav\Sharma\Controller\Index;	

use Magento\Framework\App\Action\Action;		
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;		

class Adddata extends Action
{
	/**	
     * @var \Emipro\HelloWorld\Model\SampleFactory	
     */	
    protected $_advertiseFactory;		
    /**		
     * @param Context $context	
     * @param SampleFactory $modelSampleFactory	
     */	


    public function __construct(
        Context $context,
        \Gaurav\Sharma\Model\AdvertiseFactory $advertiseFactory, 
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []) 
    {	
        
        $this->_advertiseFactory = $advertiseFactory;

        $this->_messageManager = $messageManager;

        parent::__construct($context, $data);
    }

    public function execute()	
    {

    	$data = $this->getRequest()->getParams();

    	echo "<pre>"; print_r($data); //die();

        $items = $this->_advertiseFactory->create();

        
        $collection = $items;
        $collection->setName($data['name']);
        $collection->setPostContent($data['postcontent']);
        $collection->setUrlKey($data['urlkey']);
        $collection->setStatus(1);
        $collection->setCreatedAt(date("Y-m-d h:i:s"));
        $collection->save();

        $this->_messageManager->addSuccessMessage('Your post has been added successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('sharma/index/index'));
    }


		
}