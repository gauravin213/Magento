<?php
 
namespace Clag\Homeopath\Controller\Form1;

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

        $productId = $paramsData['productId'];

        $_product = $this->product->create();
        $_product->load($productId);

        $getAddToCartProductParams =  $this->_listProduct->getAddToCartPostParams($_product);

        
        $options = array(
                $paramsData['homeopaths_enhancement'] => $paramsData['enhancement'],
                $paramsData['homeopaths_form'] => $paramsData['form']
        );

        $params = array(
                'form_key'                     => $this->formKey->getFormKey(),
                'selected_configurable_option' => $paramsData['selected_configurable_option'],
                'related_product'              => $paramsData['related_product'],   
                'super_attribute'              => $options, 
                'qty'                          => $paramsData['qty_num']           
        );


        $paramsM = array_merge($getAddToCartProductParams['data'], $params);

       
        $this->cart->addProduct($_product, $paramsM);
        $this->cart->save();
        $this->_messageManager->addSuccessMessage('Your Product has been added successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect($paramsData['redirectUrl']));
        
    }
}