<?php
namespace Clag\Customlogin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Saveforlatter extends \Magento\Framework\View\Element\Template
{

    protected $_customerSession;

    public function __construct
    (
    Context $context,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Customer\Model\SessionFactory $customerSessionFactory,
    \Clag\Customlogin\Model\SaveforlatteritemFactory $saveforlatteritemFactory,
    \Clag\Customlogin\Model\Resource\Saveforlatteritem\CollectionFactory $saveforlatteritemCollectionFactory,
    \Clag\Customlogin\Model\Resource\Saveforlatteritemoption\CollectionFactory $saveforlatteritemoptionCollectionFactory,
    \Clag\Customlogin\Model\SaveforlatteritemoptionFactory $saveforlatteritemoptionFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
    \Magento\Catalog\Model\ProductFactory $product,
    \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
    \Magento\Catalog\Block\Product\ListProduct $listProduct,
    \Magento\Wishlist\Helper\Data $wishlistHelper,
    \Magento\Catalog\Helper\Product\Compare $comparetHelper,
    array $data = []
    )
    {
        $this->_customerSession = $customerSession;
        $this->_customerSessionFactory = $customerSessionFactory;

        $this->_saveforlatteritemFactory = $saveforlatteritemFactory;
        $this->_saveforlatteritemoptionFactory = $saveforlatteritemoptionFactory;

        $this->_saveforlatteritemCollectionFactory = $saveforlatteritemCollectionFactory;
        $this->_saveforlatteritemoptionCollectionFactory = $saveforlatteritemoptionCollectionFactory;

        $this->_storeManagerInterface = $storeManagerInterface;

        $this->_product = $product;
        $this->_priceCurrency = $priceCurrency;

        $this->_listProduct = $listProduct;
        $this->_wishlistHelper = $wishlistHelper;
        $this->_comparetHelper = $comparetHelper;

        parent::__construct($context, $data);
    }

    public function getCustomerId(){
        $customer = $this->_customerSessionFactory->create();
        return $customer->getCustomer()->getId();
    }

    public function getCofigItemsOption($item_id)
    {
        $saveForLatterItemOptionCollection = $this->_saveforlatteritemoptionCollectionFactory->create();
        $saveForLatterItemOptionCollection->addFieldToFilter('item_id', array('eq' => $item_id));

        $jasonDecodeArray = array();
        $jasonDecodeArray2 = array();

        foreach ($saveForLatterItemOptionCollection as $option) {
            $jasonDecodeArray[] = json_decode($option['value']);
            $jasonDecodeArray2[] = $option['value'];
        }  

        //print_r($jasonDecodeArray);

        $uenc = $jasonDecodeArray[0]->uenc; 

        $product = $jasonDecodeArray[0]->product; 


        $qty = $jasonDecodeArray[0]->qty;


        if (array_key_exists('selected_configurable_option', $jasonDecodeArray[0])) 
        {
            $selected_configurable_option = $jasonDecodeArray[0]->selected_configurable_option; 

            $related_product = $jasonDecodeArray[0]->related_product; 

            $super_attribute = array();
            if (!empty($jasonDecodeArray[0]->selected_configurable_option)) {
                
                foreach ($jasonDecodeArray[0]->super_attribute as $key => $value) {
                    
                   $super_attribute[] = $key.":".$value;
                }
                
            }

            $itemdata = array(
                'action'=>$this->getBaseUrl().'customlogin/customer/rempvesaveforlatteraction',
                'data'=>array(
                    'uenc' => $uenc, 
                    'product' => $product,
                    'selected_configurable_option' => $selected_configurable_option,
                    'related_product' => $related_product,
                    'super_attribute' => implode(';', $super_attribute),
                    'qty' => $qty,
                    'item_id'=>$item_id,
                )
            );

            $saveforlatterParams = json_encode($itemdata);

            $reponsedata = array(
                'productId'=>$selected_configurable_option,
                'saveforlatterParams'=>$saveforlatterParams
            );


        }
        else
        {
            $itemdata = array(
                'action'=>$this->getBaseUrl().'customlogin/customer/rempvesaveforlatteraction',
                'data'=>array(
                    'uenc' => $uenc, 
                    'product' => $product,
                    'qty' => $qty,
                    'item_id'=>$item_id,
                )
            );

            $saveforlatterParams = json_encode($itemdata);

            $reponsedata = array(
                'productId'=>$product,
                'saveforlatterParams'=>$saveforlatterParams
            );
        }
       

       
        /*echo "<pre>";
        print_r($reponsedata);
        die('__________________________');*/

       return $reponsedata;


    }

    public function getSaveForLatterItemsOption()
    {
        //get values of current page
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 10;
        //get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 10;

        $SaveForLatterItemsOptionCollection = $this->_saveforlatteritemoptionCollectionFactory->create();
        $SaveForLatterItemsOptionCollection->setOrder('option_id','ASC');
        $SaveForLatterItemsOptionCollection->setPageSize($pageSize);
        $SaveForLatterItemsOptionCollection->setCurPage($page);
        return $SaveForLatterItemsOptionCollection;
    }
  
    public function getSaveForLatterItems()
    {
        $customerId = $this->getCustomerId();
        //get values of current page
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 10;
        //get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 10;

        $SaveForLatterItemsCollection = $this->_saveforlatteritemCollectionFactory->create();
        $SaveForLatterItemsCollection->setOrder('item_id','ASC');
        $SaveForLatterItemsCollection->addFieldToFilter('customer_id', array('eq' => $customerId));
        $SaveForLatterItemsCollection->setPageSize($pageSize);
        $SaveForLatterItemsCollection->setCurPage($page);
        return $SaveForLatterItemsCollection;
    }

    public function _prepareLayout()
    {   
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('SaveForLatterItems'));

        if ($this->getSaveForLatterItems()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'fme.news.pager'
            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
                $this->getSaveForLatterItems()
            );
            $this->setChild('pager', $pager);
            $this->getSaveForLatterItems()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }


    /**
     * Get cart param of product
     *
     * @return jason
    */ 
    public function getAddToCartProductParams($product)
    {
        return $this->_listProduct->getAddToCartPostParams($product);
    }


    /**
     * Get wishlist params of product
     *
     * @return jason
    */ 
    public function getWishlistProductParams($product)
    {
        return $this->_wishlistHelper->getAddParams($product);
    }

    /**
     * Get compare params of product
     *
     * @return jason
    */ 
    public function getCompareProductParams($product)
    {
        return $this->_comparetHelper->getPostDataParams($product);
    }


    /**
     * Get catalog product
     *
     * @return img tag
    */ 
    public function getProduct($productId)
    {
        $_product = $this->_product->create();
        $_product->load($productId);
        return $_product;
    }

    /**
     * Get PlaceholderImage
     *
     * @return img tag
    */ 
    public function getPlaceholderImage(){
       
        //return sprintf('<img src="%s"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg'));
        return sprintf('<img src="%s"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/small_image.jpg'));
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