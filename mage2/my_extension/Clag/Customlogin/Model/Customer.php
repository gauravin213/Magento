<?php
namespace Clag\Customlogin\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\AddressFactory $addressFactory
    )
    {
        $this->storeManager     = $storeManager;
        $this->customerFactory  = $customerFactory->create();

        $this->_customerFactory = $customerFactory;
        $this->_addressFactory = $addressFactory;

        parent::__construct($context,$registry);
    }


    public function getWebsiteId()
    {
        return $this->storeManager->getWebsite()->getWebsiteId();
    }

    public function userExists($email)
    {
        $customer = $this->customerFactory->setWebsiteId($this->getWebsiteId());
        if ($this->customerFactory->loadByEmail($email)->getId()) {
            return true;
        }  else {
            return false;
        }
    }

    public function createUser($userData)
    {


        if ($userData['group_id'] == 4) {

            try {
                $customer = $this->customerFactory->setWebsiteId($this->getWebsiteId());
                $customer->setGroupId($userData['group_id']);
                $customer->setFirstname($userData['firstname']);
                $customer->setLastname($userData['lastname']);
                $customer->setEmail($userData['email']);
                $customer->setMobile($userData['mobile']);
                $customer->setPhone($userData['telephone']);
                $customer->setPassword($userData['password']);

                if ($customer->save()) 
                {
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }
           
        }

        if ($userData['group_id'] == 5) {

            try {
                $customer = $this->customerFactory->setWebsiteId($this->getWebsiteId());
                $customer->setGroupId($userData['group_id']);
                $customer->setFirstname($userData['firstname']);
                $customer->setLastname($userData['lastname']);
                $customer->setEmail($userData['email']);
                $customer->setMobile($userData['mobile']);
                $customer->setPhone($userData['telephone']);
                $customer->setSpeciality($userData['speciality']);
                $customer->setRegistryNumber($userData['registry_number']);
                $customer->setPassword($userData['password']);

                if ($customer->save()) 
                {
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }
           
        }

        if ($userData['group_id'] == 6) {

            try {
                $customer = $this->customerFactory->setWebsiteId($this->getWebsiteId());
                $customer->setGroupId($userData['group_id']);
                $customer->setFirstname($userData['firstname']);
                $customer->setLastname($userData['lastname']);
                $customer->setEmail($userData['email']);
                $customer->setMobile($userData['mobile']);
                $customer->setPhone($userData['telephone']);
                $customer->setCompanyName($userData['companyname']);
                $customer->setTaxvat($userData['vat']);
                $customer->setAddress($userData['address']);
                $customer->setPassword($userData['password']);

                if ($customer->save()) 
                {
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }
           
        }

    }
}
