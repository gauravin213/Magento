<?php 
namespace Clag\Customlogin\Controller\Customer;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;   


use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\Exception\EmailNotConfirmedException;
use Magento\Framework\Exception\InvalidEmailOrPasswordException;
use Magento\Framework\App\ObjectManager;
use Magento\Customer\Model\Account\Redirect as AccountRedirect;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;

class Login extends \Magento\Framework\App\Action\Action 
{ 

	protected $sessionFactory;

	public function __construct
    (
        Context $context,
        \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement,
        \Magento\Framework\Json\Helper\Data $helper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Customer\Model\Session $customerSession, 
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Clag\Customlogin\Helper\Data $getCookiedata,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $CookieMetadataFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $CookieManagerInterface,
        array $data = []
    ) 
    {   

    	$this->customerAccountManagement = $customerAccountManagement;
    	$this->helper = $helper;
    	$this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->_customerUrl = $customerUrl;
        $this->customerSession = $customerSession;
    	$this->sessionFactory = $sessionFactory;
        $this->getCookiedata = $getCookiedata;

        $this->CookieMetadataFactory = $CookieMetadataFactory;
        $this->CookieManagerInterface = $CookieManagerInterface;

        parent::__construct($context, $data);
    }


    public function getAccountUrl()
    {
        return $this->_customerUrl->getAccountUrl();
    }

    protected function getAccountRedirect()
    {
        if (!is_object($this->accountRedirect)) {
            $this->accountRedirect = ObjectManager::getInstance()->get(AccountRedirect::class);
        }
        return $this->accountRedirect;
    }

 
    public function setAccountRedirect($value)
    {
        $this->accountRedirect = $value;
    }

   
    protected function getScopeConfig()
    {
        if (!is_object($this->scopeConfig)) {
            $this->scopeConfig = ObjectManager::getInstance()->get(ScopeConfigInterface::class);
        }
        return $this->scopeConfig;
    }

  
    public function setScopeConfig($value)
    {
        $this->scopeConfig = $value;
    }


     /*Cookie*/
    /**
    * Retrieve cookie manager
    *
    * @deprecated
    * @return \Magento\Framework\Stdlib\Cookie\PhpCookieManager
    */
   private function getCookieManager()
   {
       if (!$this->CookieManagerInterface) {
           $this->CookieManagerInterface = \Magento\Framework\App\ObjectManager::getInstance()->get(
               \Magento\Framework\Stdlib\Cookie\PhpCookieManager::class
           );
       }
       return $this->CookieManagerInterface;
   }

   /**
    * Retrieve cookie metadata factory
    *
    * @deprecated
    * @return \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
    */
   private function getCookieMetadataFactory()
   {
       if (!$this->CookieMetadataFactory) {
           $this->CookieMetadataFactory = \Magento\Framework\App\ObjectManager::getInstance()->get(
               \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory::class
           );
       }
       return $this->CookieMetadataFactory;
   }
    /*Cookie*/


	public function execute()
    {
        $credentials = null;
        $httpBadRequestCode = 400;

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        try {

            $credentials = [
                                'username' => $this->getRequest()->getPost('username'),
                                'password' => $this->getRequest()->getPost('password'),
                                'rememberme' => $this->getRequest()->getPost('rememberme')
                            ];

            /*Cookie*/
            if (array_key_exists('rememberme',$credentials)) {
                       $logindetails = array('username' => $credentials['username'], 'password' => $credentials['password'], 'remchkbox' => 1);
                       $logindetails = json_encode($logindetails);
                       $this->getCookiedata->set($logindetails, $this->getCookiedata->getCookielifetime());
                   } else {
                       $this->getCookiedata->delete('remember');
                   }
            /*Cookie*/


        } catch (\Exception $e) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }
        if (!$credentials || $this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        $response = [
            'errors' => false,
            'message' => __('Login successful.')
        ];
        try {
            $customer = $this->customerAccountManagement->authenticate(
                $credentials['username'],
                $credentials['password']
            );
            $this->customerSession->setCustomerDataAsLoggedIn($customer);
            $this->customerSession->regenerateId();

            /*Cookie*/
            if ($this->getCookieManager()->getCookie('mage-cache-sessid')) {
                $metadata = $this->getCookieMetadataFactory()->createCookieMetadata();
                $metadata->setPath('/');
                $this->getCookieManager()->deleteCookie('mage-cache-sessid', $metadata);
            }
            /*Cookie*/

            /*$redirectRoute = $this->getAccountRedirect()->getRedirectCookie();
            if (!$this->getScopeConfig()->getValue('customer/startup/redirect_dashboard') && $redirectRoute) {
                $response['redirectUrl'] = $this->_redirect->success($redirectRoute);
                $this->getAccountRedirect()->clearRedirectCookie();
            }*/

            if ($this->getAccountUrl()) {
            	$response['redirectUrl'] = $this->getAccountUrl();
            }
            

        } catch (EmailNotConfirmedException $e) {
            $response = [
                'errors' => true,
                'message' => $e->getMessage()
            ];
        } catch (InvalidEmailOrPasswordException $e) {
            $response = [
                'errors' => true,
                'message' => $e->getMessage()
            ];
        } catch (LocalizedException $e) {
            $response = [
                'errors' => true,
                'message' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'message' => __('Invalid login or password.').$e->getMessage()
            ];
        }


        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);

        //echo $this->getAccountUrl();
        //die("ooppp");
    }
  
} 