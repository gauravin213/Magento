<?php 
namespace Clag\Customlogin\Controller\Customer;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory; 
use Magento\Framework\Exception\LocalizedException;  

class Register extends \Magento\Framework\App\Action\Action 
{ 

    public function __construct
    (
        Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Json\Helper\Data $helper,
        \Clag\Customlogin\Model\Customer $customerModel,
        \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        array $data = []
    ) 
    {   
        $this->customerSession = $customerSession;
        $this->helper = $helper;
        $this->customerModel = $customerModel;
        $this->customerAccountManagement = $customerAccountManagement;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context, $data);
    }


    /*public function execute()
    {
        die("Register");
    }*/

    public function execute()
    {
        $userData = null;
        $httpBadRequestCode = 400;
        $response = [
            'errors' => false,
            'message' => __('Registration successful.')
        ];

        if ($this->customerModel->userExists($this->getRequest()->getPost('email'))) 
        {
            $response = [
                'errors' => true,
                'message' => __('A user already exists with this email id.')
            ];
        } 
        else 
        {
            /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
            $resultRaw = $this->resultRawFactory->create();

            try {

                $groupdId = $this->getRequest()->getPost('group_id');

                if ($groupdId == 4) {

                    $userData = ['group_id' => $this->getRequest()->getPost('group_id'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'firstname' => $this->getRequest()->getPost('firstname'),
                            'lastname' => $this->getRequest()->getPost('lastname'),
                            'email' => $this->getRequest()->getPost('email'),
                            'password' => $this->getRequest()->getPost('password'),
                            'password_confirmation' => $this->getRequest()->getPost('password_confirmation'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'mobile' => $this->getRequest()->getPost('mobile'),
                            'phone' => $this->getRequest()->getPost('telephone')];
                   
                }

                if ($groupdId == 5) {

                    $userData = ['group_id' => $this->getRequest()->getPost('group_id'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'firstname' => $this->getRequest()->getPost('firstname'),
                            'lastname' => $this->getRequest()->getPost('lastname'),
                            'email' => $this->getRequest()->getPost('email'),
                            'password' => $this->getRequest()->getPost('password'),
                            'password_confirmation' => $this->getRequest()->getPost('password_confirmation'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'mobile' => $this->getRequest()->getPost('mobile'),
                            'phone' => $this->getRequest()->getPost('telephone'),
                            'speciality' => $this->getRequest()->getPost('speciality'),
                            'registry_number' => $this->getRequest()->getPost('registry_number')
                        ];
                   
                }

                if ($groupdId == 6) {

                    $userData = ['group_id' => $this->getRequest()->getPost('group_id'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'firstname' => $this->getRequest()->getPost('firstname'),
                            'lastname' => $this->getRequest()->getPost('lastname'),
                            'email' => $this->getRequest()->getPost('email'),
                            'password' => $this->getRequest()->getPost('password'),
                            'password_confirmation' => $this->getRequest()->getPost('password_confirmation'),
                            'telephone' => $this->getRequest()->getPost('telephone'),
                            'mobile' => $this->getRequest()->getPost('mobile'),
                            'phone' => $this->getRequest()->getPost('telephone'),
                            'companyname' => $this->getRequest()->getPost('companyname'),
                            'vat' => $this->getRequest()->getPost('vat'),
                            'address' => $this->getRequest()->getPost('address')
                        ];
                   
                }

            } catch (\Exception $e) {
                return $resultRaw->setHttpResponseCode($httpBadRequestCode);
            }

            if (!$userData || $this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
                return $resultRaw->setHttpResponseCode($httpBadRequestCode);
            }

            try {

                $isUserRegistered = $this->customerModel->createUser($userData);
                if (!$isUserRegistered) {
                    $response = [
                        'errors' => true,
                        'message' => __('Something went wrong.')
                    ];
                } else {
                    $customer = $this->customerAccountManagement->authenticate(
                        $userData['email'],
                        $userData['password']
                    );
                    $this->customerSession->setCustomerDataAsLoggedIn($customer);
                    $this->customerSession->regenerateId();
                }

                
            } catch (LocalizedException $e) {
                $response = [
                    'errors' => true,
                    'message' => $e->getMessage()
                ];
            } catch (\Exception $e) {
                $response = [
                    'errors' => true,
                    'message' => __('Something went wrong.')
                ];
            }
        }

            
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
  
} 