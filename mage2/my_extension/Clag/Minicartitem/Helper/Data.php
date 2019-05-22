<?php

namespace Clag\Minicartitem\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    protected $storeManager;
    protected $objectManager;



    public function __construct(Context $context,
        ObjectManagerInterface $objectManager,
        StoreManagerInterface $storeManager,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
    ) {
        $this->objectManager = $objectManager;
        $this->storeManager  = $storeManager;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context);
    }

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }


    public function getSaveforlaterActionUrl($pid)
    {
        $acurl = $this->storeManagerInterface->getStore()->getBaseUrl().'customlogin/customer/saveforlatteraction';

        $data = array('product'=> $pid);

        $getParam = array('action'=>$acurl,'data'=>$data);

        $getParam1 = json_encode($getParam);

        return $getParam1;
    }


}