<?php 
namespace Clag\Customlogin\Controller\Customer;  
       
use Magento\Framework\Controller\ResultFactory;   

class Rempvesaveforlatteraction extends \Magento\Framework\App\Action\Action 
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


        /*echo "<pre>";
        print_r($ParamsData);
        die();*/


        $productId = $ParamsData['product'];
        $item_id = $ParamsData['item_id'];

        /**/
        $_product = $this->_product->create()->load($productId );

        if ($_product->getTypeId() == "configurable") 
        {
            //configurable product 

            $explode1 = explode(';', $ParamsData['super_attribute']);

            foreach ($explode1 as $data_explode1) 
            {
                $explode2[] = explode(':', $data_explode1);
            }

            $options = array();
            foreach ($explode2 as $explodes2) {
                $options[$explodes2[0]] = $explodes2[1];
            }

            $params = array(
                'form_key'                     => $this->formKey->getFormKey(),
                'uenc'                         => $ParamsData['uenc'],
                'product'                      => $productId, 
                'selected_configurable_option' => $ParamsData['selected_configurable_option'],
                'related_product'              => $ParamsData['related_product'],   
                'super_attribute'              => $options, 
                'qty'                          => $ParamsData['qty']           
            );      
        } 
        else 
        {
            //simple product  
             $params = array(
                'form_key'                     => $this->formKey->getFormKey(),
                'uenc'                         => $ParamsData['uenc'],
                'product'                      => $productId,  
                'qty'                          => $ParamsData['qty']           
            );               
        }

      
        $this->_cartModel->addProduct($_product, $params);
        $this->_cartModel->save();
        /**/



        /**/
        $item = $this->_saveforlatteritemFactory->create()->load($item_id);
        $item->delete();

        $itemOption = $this->_saveforlatteritemoptionFactory->create()->getCollection();
        $itemOption->addFieldToFilter('item_id', array('eq' => $item_id));

        foreach ($itemOption as $optiondata) {
            $optiondata->delete();
        }
        /**/

        $this->_messageManager->addSuccessMessage('Item addede successfully to cart');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('checkout/cart/'));
    
        //die('Rempvesaveforlatteraction');
    }
  
} 