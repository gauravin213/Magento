<?php

namespace Clagtech\Clagmp\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends \Magento\Framework\View\Element\Template
{

	protected $_clagpostFactory;

    protected $catalogSession;

    public function __construct
    (
    Context $context,
    \Clagtech\Clagmp\Model\ClagpostFactory $clagpostFactory,  
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Catalog\Model\Session $catalogSession,
    array $data = []
    )
    {

        $this->_clagpostFactory = $clagpostFactory;

        $this->_customerSession = $customerSession;

        $this->catalogSession = $catalogSession;

        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {

        //$this->catalogSession->setMyValue('test');
        echo $this->catalogSession->getMyValue();


        $customer_id = $this->_customerSession->getCustomerId();

        $items = $this->_clagpostFactory->create();

    
        $post_type = $this->getRequest()->getParams();

        if(isset($post_type['post_type'])) 
        {
            $post_type = $post_type['post_type'];
            
            switch ($post_type) {
                case "pending":
                    $collection = $items->getCollection()
                                ->addFieldToFilter('status',array('eq' => 0))
                                ->addFieldToFilter('trash',array('eq' => 0));
                    break;
                case "approved":
                    $collection = $items->getCollection()
                                ->addFieldToFilter('status',array('eq' => 1))
                                ->addFieldToFilter('trash',array('eq' => 0));
                    break;
                case "archive":
                    $collection = $items->getCollection()
                                ->addFieldToFilter('trash',array('eq' => 1));
                    break;
                default:
                    $collection = $items->getCollection()
                                ->addFieldToFilter('trash',array('eq' => 0));
            }
        } 
        else 
        {
            $collection = $items->getCollection()
                        ->addFieldToFilter('trash',array('eq' => 0));
        }

        $this->setAdvertiseType($post_type);
      
        $this->setCollection($collection);

        $this->setCustomerId($customer_id);
        

        
    }


    public function getHelloWorldTxt()
    {
        return 'Clagtech\Clagmp extension';
    }

}