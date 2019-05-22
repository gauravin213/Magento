<?php
namespace Clag\Customlogin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Customlogin extends \Magento\Framework\View\Element\Template
{

    protected $_customerSession;

    //protected $_customerSession;

    public function __construct
    (
    Context $context,
    //\Magento\Customer\Model\Session $customerSession,
    \Magento\Framework\App\Request\Http $request,
    \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
    \Magento\Customer\Model\SessionFactory $customerSession,
    \Magento\Catalog\Model\Session $catalogSession,
    \Magento\Store\Model\StoreManagerInterface $StoreManagerInterface,
    \Clag\Customlogin\Helper\Data $Rememberme,
    array $data = []
    )
    {

        //$this->_customerSession = $customerSession;

        $this->catalogSession = $catalogSession;

        $this->StoreManagerInterface = $StoreManagerInterface;

        $this->request = $request;
        $this->customerRepository = $customerRepository;
        $this->_customerSession = $customerSession;

        $this->Rememberme = $Rememberme;

        parent::__construct($context, $data);
    }

    public function getCustomerId(){
        $customer = $this->_customerSession->create();
        return $customer->getCustomer()->getId();
    }

    public function _prepareLayout()
    {
        /*$store = $this->StoreManagerInterface->getStore();
        echo $mideaBasewUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);*/
    }
}