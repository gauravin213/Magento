<?php

namespace Gaurav\Sharma\Block;


use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Sharma extends \Magento\Framework\View\Element\Template
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
    	$data = $this->getRequest()->getParams('id');

        $items = $this->_advertiseFactory->create();

        $collection = $items->load($data['id']);

        $this->setCollection($collection);

    }

    public function getHelloWorldTxt()
    {
        return 'Edit data';
    }
}