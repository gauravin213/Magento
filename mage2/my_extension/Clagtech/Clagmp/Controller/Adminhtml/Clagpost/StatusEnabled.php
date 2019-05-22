<?php

namespace Clagtech\Clagmp\Controller\Adminhtml\Clagpost;

class StatusEnabled extends \Magento\Backend\App\Action
{
    
    protected $_filter;

    protected $_collectionFactory;

    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Clagtech\Clagmp\Model\ResourceModel\Clagpost\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }


   
    public function execute()
    {

        $status = $this->getRequest()->getParam('status');

        echo $status;


        //$collection = $this->collectionFactory->create();
       
        //array_push($collection,"blue","yellow");

        

        echo "<pre>"; 

        //print_r($collection->getData());

        print_r($status);



        die("StatusEnabled");
    }
}
