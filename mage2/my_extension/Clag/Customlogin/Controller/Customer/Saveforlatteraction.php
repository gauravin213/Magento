<?php 
namespace Clag\Customlogin\Controller\Customer;  
       
use Magento\Framework\Controller\ResultFactory;   

class Saveforlatteraction extends \Magento\Framework\App\Action\Action 
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
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
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
        $this->checkoutSession = $checkoutSession;
        $this->_messageManager = $messageManager;
        parent::__construct($context, $data);
    }


    public function execute()
    {

        $ParamsData = $this->getRequest()->getParams();

        /*echo "<pre>";
        print_r($ParamsData); 

        echo $ParamsData['product'];
        die();*/

        //$ParamsData['productId'] = 80; //51, 41, 79, 80

        $storeId = $this->_storeManagerInterface->getStore()->getId();

        $quoteItemCollection = $this->_objectManager->create(\Magento\Quote\Model\ResourceModel\Quote\Item\Collection::class);

        $quote = $this->_cartModel->getQuote();

        $quote->setStoreId($storeId);

        $quoteItemCollection
            ->setQuote($quote)
            ->addFieldToFilter('product_id', $ParamsData['product']); 


        //for removing item from cart
        $quote_item_id = $quoteItemCollection->getData()[0]['item_id'];
       

        if (count($quoteItemCollection->getData()) == 0) 
        {
            /*$response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData(['result' => 0]);
            return $response;*/

            $this->_messageManager->addSuccessMessage('There are some error to Save for latter list');
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect('checkout/cart/'));
        } 
        else 
        {
            $newItem = $quoteItemCollection->getFirstItem();

            $jasonDecodeArray = array();
            $optionArrayData = array();

            foreach ($newItem->getOptions() as $option) {

                $optionArrayData[] = $option->getData();

                $jasonDecodeArray[] = json_decode($option['value']);
            }  


            
            $uenc = $jasonDecodeArray[0]->uenc; 
           
            $product = $ParamsData['product']; //$jasonDecodeArray[0]->product; 

            if (array_key_exists('selected_configurable_option', $jasonDecodeArray[0])) 
            {
                $selected_configurable_option = $jasonDecodeArray[0]->selected_configurable_option; 

                $related_product = $jasonDecodeArray[0]->related_product; 

                $super_attribute = "";
                if (!empty($jasonDecodeArray[0]->selected_configurable_option)) {
                   $super_attribute = $jasonDecodeArray[0]->super_attribute; 
        
                }
                else 
                {
                   $super_attribute = "";
                }
            } 

            $qty = $jasonDecodeArray[0]->qty; 

            $customerId = $this->customerSession->getCustomer()->getId();

            $date = $this->date->gmtDate();



            /**/ 
            // selected_configurable_option,  related_product, super_attribute 
           // echo "<pre>";
            //print_r($jasonDecodeArray[0]);
            //die('@@');
            /**/


          
            /*
            * Start Code :: Save item to Save for latter tables
            */

            //Save item to 'save_for_latter_item' table
            $items = $this->_saveforlatteritemFactory->create();
            $collection = $items;
            $collection->setCustomerId($customerId);
            $collection->setProductId($product);
            $collection->setStoreId($storeId);
            $collection->setAddedDate($date);
            $collection->setQty($qty);
            $collection->save();
            $itemID = $collection->getItemId();

            foreach ($optionArrayData as $value) {
                //Save item to 'save_for_latter_item_option' table
                $itemsOpt = $this->_saveforlatteritemoptionFactory->create();
                $collectionOpt = $itemsOpt;
                $collectionOpt->setItemId($itemID);
                $collectionOpt->setProductId($value['product_id']);
                $collectionOpt->setCode($value['code']);
                $collectionOpt->setValue($value['value']);
                $collectionOpt->save();
            }
            /*
            * End Code :: Save item to Save for latter tables
            */


           /*
           * Start Code :: Remove item from cart data
           */
            $this->_cartModel->removeItem($quote_item_id)->save();
           /*
           * End Code :: Remove item from cart data
           */

            /*$response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData(['result' => 1]);
            return $response;*/


            $this->_messageManager->addSuccessMessage('Item addede successfully to Save for latter list');
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect('checkout/cart/'));

        }
        

        
    }
  
} 