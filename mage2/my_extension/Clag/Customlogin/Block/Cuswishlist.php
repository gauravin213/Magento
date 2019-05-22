<?php
namespace Clag\Customlogin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Cuswishlist extends \Magento\Framework\View\Element\Template
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
    \Magento\Wishlist\Model\Wishlist $wishlist,
    \Magento\Catalog\Model\ProductFactory $Product,
    \Magento\Wishlist\Controller\WishlistProviderInterface $wishlistProviderInterface,
    \Magento\Wishlist\Model\ItemFactory $itemFactory,
    \Magento\Framework\Message\ManagerInterface $messageManager,
    \Magento\Store\Model\StoreManagerInterface $StoreManagerInterface,
    \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
    \Magento\Catalog\Block\Product\ListProduct $listProductBlock,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,

    array $data = []
    )
    {
        //$this->_customerSession = $customerSession;

        $this->catalogSession = $catalogSession;

        $this->wishlist = $wishlist;
        $this->Product = $Product;
        $this->_wishlistProviderInterface = $wishlistProviderInterface;
        $this->_itemFactory = $itemFactory;

        $this->request = $request;
        $this->customerRepository = $customerRepository;
        $this->_customerSession = $customerSession;
        $this->_messageManager = $messageManager;

        $this->StoreManagerInterface = $StoreManagerInterface;

        $this->_priceCurrency = $priceCurrency;

        $this->_productCollectionFactory = $productCollectionFactory;
        $this->listProductBlock = $listProductBlock;

        $this->_storeConfig = $scopeConfig;

        parent::__construct($context, $data);
    }

    public function getPlaceholderImage(){
       
        return sprintf('<img src="%s"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg'));
    }

    public function getCustomerId(){
        $customer = $this->_customerSession->create();
        return $customer->getCustomer()->getId();
    }

    public function getAddToCartPostParams($product)
    {
        return $this->listProductBlock->getAddToCartPostParams($product);
    }

    public function _prepareLayout()
    {

        $customer_id = $this->getCustomerId();
        $wishlist_collection = $this->wishlist->loadByCustomerId($customer_id, true)->getItemCollection();

        $this->setCollection($wishlist_collection);

       
    }

    /**
     * Get current currency code
     *
     * @return string
    */ 
    public function getCurrentCurrencyCode()
    {
      return $this->_priceCurrency->getCurrency()->getCurrencyCode();
    }

    /**
     * Get current currency symbol
     *
     * @return string
     */ 
    public function getCurrentCurrencySymbol()
    {
      return $this->_priceCurrency->getCurrency()->getCurrencySymbol();
    }

}