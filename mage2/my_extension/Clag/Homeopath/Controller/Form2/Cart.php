<?php
 
namespace Clag\Homeopath\Controller\Form2;

use Magento\Framework\Controller\ResultFactory;   
 
class Cart extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $formKey;   
    protected $cart;
    protected $product;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\ProductFactory $product,
        \Magento\Catalog\Block\Product\ListProduct $listProduct,
        \Magento\Wishlist\Helper\Data $wishlistHelper,
        \Magento\Catalog\Helper\Product\Compare $comparetHelper
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_messageManager = $messageManager;
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->product = $product;   

        $this->_listProduct = $listProduct;
        $this->_wishlistHelper = $wishlistHelper;
        $this->_comparetHelper = $comparetHelper;

        parent::__construct($context);
    }
 
    public function execute()
    {
       
        $paramsData = $this->getRequest()->getParams();   

        $size = sizeof($paramsData['arr']['productId']);

        for($k=0;$k<$size;$k++)
        {
          
            $productId      = $paramsData['arr']['productId'][$k];
            $enhancement    = $paramsData['arr']['enhancement'][$k];
            $form           = $paramsData['arr']['form'][$k];
            $qty            = $paramsData['arr']['qty_num'][$k];
            $related_product            = $paramsData['arr']['related_product'][$k];
            $selected_configurable_option  = $paramsData['arr']['selected_configurable_option'][$k];

            $_product = $this->product->create();  
            $_product->load($productId); 

            $getAddToCartProductParams =  $this->_listProduct->getAddToCartPostParams($_product);

            $params = array(
                'form_key'                     => $this->formKey->getFormKey(),
                'selected_configurable_option' => $selected_configurable_option,
                'related_product'              => $related_product,   
                'super_attribute'              => array(
                                                        $paramsData['homeopaths_enhancement'] => $enhancement,
                                                        $paramsData['homeopaths_form'] => $form
                                                    ),          
                'qty'                          => $qty          
            );
            $paramsM = array_merge($getAddToCartProductParams['data'], $params);
            $this->cart->addProduct($_product, $paramsM);
            
        }

        $this->cart->save(); 

        $this->_messageManager->addSuccessMessage('Your Product has been added successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect($paramsData['redirectUrl']));
    }
}