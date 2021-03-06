<?php 
namespace Clag\Customlogin\Controller\Customer;  
       
use Magento\Framework\Controller\ResultFactory;   

class Deletesaveforlatteraction extends \Magento\Framework\App\Action\Action 
{ 

    public function __construct
    (
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Cart $cartModel,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Clag\Customlogin\Model\SaveforlatteritemFactory $saveforlatteritemFactory,
        \Clag\Customlogin\Model\SaveforlatteritemoptionFactory $saveforlatteritemoptionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Catalog\Model\ProductFactory $product,
        array $data = []
    ) 
    {   
        $this->customerSession = $customerSession;
        $this->_cartModel = $cartModel;
        $this->_storeManagerInterface = $storeManagerInterface;
        $this->_objectManager = $objectmanager;
        $this->_saveforlatteritemFactory = $saveforlatteritemFactory;
        $this->_saveforlatteritemoptionFactory = $saveforlatteritemoptionFactory;
        $this->date = $date;
        $this->_messageManager = $messageManager;
        $this->formKey = $formKey;
        $this->_product = $product;  
        parent::__construct($context, $data);
    }


    public function execute()
    {

        $ParamsData = $this->getRequest()->getParams(); 

        $item_id = $ParamsData['item_id'];

        //Delete item from save for later table
        $item = $this->_saveforlatteritemFactory->create()->load($item_id);
        $item->delete();

        $itemOption = $this->_saveforlatteritemoptionFactory->create()->getCollection();
        $itemOption->addFieldToFilter('item_id', array('eq' => $item_id));

        foreach ($itemOption as $optiondata) {
            $optiondata->delete();
        }
       
        $this->_messageManager->addSuccessMessage("Item has been removed successfully from 'Save for later list'");
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('checkout/cart/'));


    }
  
} 