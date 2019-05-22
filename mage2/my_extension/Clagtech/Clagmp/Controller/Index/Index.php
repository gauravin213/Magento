<?php
 
namespace Clagtech\Clagmp\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{

	protected $_customerSession;
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Customer\Model\Session $customerSession,
     array $data = []
    ) 
   	{
        
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);

    }


    public function execute()
    {
    	$customer = $this->_customerSession->getCustomerId();

    	if ($customer) 
    	{
   			$this->_view->loadLayout();
        	$this->_view->renderLayout();
    	} 
    	else 
    	{
    		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
			$resultRedirect->setUrl($this->_redirect('customer/account/login'));
    	}

    	/*$this->_view->loadLayout();
        $this->_view->renderLayout();*/
    	
    }
}