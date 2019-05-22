<?php
namespace Clag\Homeopath\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Form1 extends \Magento\Framework\View\Element\Template
{

	/**
     * Eav Entity Attribute Collection
     *
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */
    protected $_entityAttributeCollection;
     
    /**
     * @var \Magento\Eav\Model\Entity\Attribute
     */ 
    protected $_entityAttribute;
     
    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection
     */ 
    protected $_attributeOptionCollection;

    protected $productRepository;
        
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection $eavEntityAttributeCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection $entityAttributeCollection,
        \Magento\Eav\Model\Entity\Attribute $entityAttribute,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection $attributeOptionCollection,
        \Magento\Catalog\Model\ProductFactory $Product,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Catalog\Block\Product\ListProduct $listProduct,
        \Magento\Wishlist\Helper\Data $wishlistHelper,
        \Magento\Catalog\Helper\Product\Compare $comparetHelper,
        \Clag\Homeopath\Helper\Data $helperData,
        array $data = []
    ) {
        $this->_entityAttributeCollection = $entityAttributeCollection; 
        $this->_entityAttribute = $entityAttribute;
        $this->_attributeOptionCollection = $attributeOptionCollection;
        $this->Product = $Product;
        $this->productRepository = $productRepository;
        $this->_priceCurrency = $priceCurrency;

        $this->_listProduct = $listProduct;
        $this->_wishlistHelper = $wishlistHelper;
        $this->_helperData = $helperData;
        $this->_comparetHelper = $comparetHelper;
     
        parent::__construct($context, $data);
    }
     
    /**
     * Load attribute data by code
     *
     * @param   mixed $entityType    Can be integer, string, or instance of class Mage\Eav\Model\Entity\Type
     * @param   string $attributeCode
     * @return  \Magento\Eav\Model\Entity\Attribute
     */
    public function getAttributeInfo($entityType, $attributeCode)
    {
        return $this->_entityAttribute
                    ->loadByCode($entityType, $attributeCode);
    }
     
    /**
     * Get all options of an attribute
     *
     * @param   int $attributeId
     * @return  \Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection
     */
    public function getAttributeOptionAll($attributeId)
    {
        return $this->_attributeOptionCollection
                    ->setPositionOrder('asc')
                    ->setAttributeFilter($attributeId)
                    ->setStoreFilter()
                    ->load();
    }
     
    /**
     * Get attribute option data of a single option of the attribute
     *
     * @param   int $attributeId
     * @param   int $optionId
     * @return  \Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection
     */
    public function getAttributeOptionSingle($attributeId, $optionId)
    {
        return $this->_attributeOptionCollection
                    ->setPositionOrder('asc')
                    ->setAttributeFilter($attributeId)
                    ->setIdFilter($optionId)
                    ->setStoreFilter()
                    ->load()
                    ->getFirstItem();
    }
     
    /**
     * Get attributes by code
     * Multiple entity types can have same attribute code
     * Entity types 'catalog_product' & 'catalog_category' both have 'name' attribute code
     * So, this function can return object of size greater than 1
     *
     * @return Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */ 
    public function getAttributesByCode($code) {
        $this->_entityAttributeCollection->getSelect()->join(
                    ['eav_entity_type'=>$this->_entityAttributeCollection->getTable('eav_entity_type')],
                    'main_table.entity_type_id = eav_entity_type.entity_type_id',
                    ['entity_type_code'=>'eav_entity_type.entity_type_code']);                
        
        $attributes = $this->_entityAttributeCollection->setCodeFilter($code);
        
        return $attributes;
    }
     
    /**
     * Get single product attribute data 
     *
     * @return Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */
    public function getProductAttributeByCode($code) {
        $this->_entityAttributeCollection->getSelect()->join(
                    ['eav_entity_type'=>$this->_entityAttributeCollection->getTable('eav_entity_type')],
                    'main_table.entity_type_id = eav_entity_type.entity_type_id',
                    ['entity_type_code'=>'eav_entity_type.entity_type_code']);                
        
        $attribute = $this->_entityAttributeCollection
                          ->setCodeFilter($code)
                          ->addFieldToFilter('entity_type_code', 'catalog_product')
                          ->getFirstItem();
        
        return $attribute;
    }



    /**
     * Get product by id
     *
     * @return string
    */ 
    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }

    /**
     * Get product by sku 
     *
     * @return string
    */ 
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
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


    public function _prepareLayout()
    {
       

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
}