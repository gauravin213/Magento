<?php

namespace Gaurav\Sharma\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Advertise extends \Magento\Framework\View\Element\Template
{

    protected $_advertiseFactory;

    public function __construct
    (
    Context $context,
    \Gaurav\Sharma\Model\AdvertiseFactory $advertiseFactory,  
    array $data = []
    )
    {

        $this->_advertiseFactory = $advertiseFactory;

        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        $post_type = $this->getRequest()->getParams();

        $items = $this->_advertiseFactory->create();

        if(isset($post_type['post_type'])) 
        {
            $post_type = $post_type['post_type'];
            
            switch ($post_type) {
                case "open":
                    $collection = $items->getCollection()
                                ->addFieldToFilter('status',array('eq' => 1));
                    break;
                case "archive":
                    $collection = $items->getCollection()
                                ->addFieldToFilter('status',array('eq' => 0));
                    break;
                default:
                    $collection = $items->getCollection();
            }
        } 
        else 
        {
            $collection = $items->getCollection();
        }

        $this->setAdvertiseType($post_type);
        $this->setCollection($collection);
    }

    public function getHelloWorldTxt()
    {
        return 'Shmodule1';
    }

}