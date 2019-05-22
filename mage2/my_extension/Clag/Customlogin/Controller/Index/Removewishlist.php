<?php
 
namespace Clag\Customlogin\Controller\Index;
 
use Magento\Framework\Controller\ResultFactory;  
 
class Removewishlist extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\View\Result\PageFactory $resultFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Wishlist\Controller\WishlistProviderInterface $wishlistProviderInterface,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\Product $product,
        \Magento\Wishlist\Model\Wishlist $wishlist
    )
    {
        $this->resultFactory = $resultFactory;
        $this->_messageManager = $messageManager;
        $this->wishlist = $wishlist;
        $this->_wishlistProviderInterface = $wishlistProviderInterface;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->product = $product;   

        parent::__construct($context);
    }
 
    public function execute()
    {
        $data = $this->getRequest()->getParams();

        /*echo "<pre>";
        print_r($data);
        echo "</pre>"; 
        die();*/

        if (isset($data['RemoveBeforAddtocart'])) 
        {

            /*Addtocart*/
            $productId =$data['ProductId'];

            $params = array(
                        'form_key' => $this->formKey->getFormKey(),
                        'product' => $productId, //product Id
                        'qty'   => $data['qty'], //quantity of product               
                    );              
            //Load the product based on productID   
            $_product = $this->product->load($productId);       
            $this->cart->addProduct($_product, $params);
            $this->cart->save();
           /*Addtocart*/

            /**/
            $customerId = $data['CustomerId'];
            $productId = $data['ProductId'];
            $wish = $this->wishlist->loadByCustomerId($customerId);
            $items = $wish->getItemCollection();

            foreach ($items as $item) {
                if ($item->getProductId() == $productId) {
                    $item->delete();
                    $wish->save();
                }
            }

            /*$types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
            foreach ($types as $type) {
                $this->_cacheTypeList->cleanType($type);
            }*/
            /*foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }*/

        
            $this->_messageManager->addSuccessMessage('Your Item has been added into the cart successfully');
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect('customlogin/index/cuswishlistac')); 
            /**/
        } 
        else 
        {
            /**/
            $customerId = $data['CustomerId'];
            $productId = $data['ProductId'];
            $wish = $this->wishlist->loadByCustomerId($customerId);
            $items = $wish->getItemCollection();

            foreach ($items as $item) {
                if ($item->getProductId() == $productId) {
                    $item->delete();
                    $wish->save();
                }
            }

            /*$types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
            foreach ($types as $type) {
                $this->_cacheTypeList->cleanType($type);
            }*/
            /*foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }*/

        
            $this->_messageManager->addSuccessMessage('Your Item removed successfully');
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect('customlogin/index/cuswishlistac')); 
            /**/
        }
        
        
    }
}