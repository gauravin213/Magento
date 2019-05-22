<?php
namespace Clag\Customlogin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Customerproductreviewlist extends \Magento\Framework\View\Element\Template
{

    protected $customerSession;

    public function __construct
    (
    Context $context,
    \Magento\Customer\Model\SessionFactory $customerSession,
    \Magento\Catalog\Model\Session $catalogSession,
    \Magento\Framework\App\ResourceConnection $resource,
    \Magento\Catalog\Model\ProductFactory $Product,
    \Magento\Review\Model\ResourceModel\Review\CollectionFactory $ReviewCollectionFactory,
    \Magento\Store\Model\StoreManagerInterface $StoreManagerInterface,
    array $data = []
    )
    {

        $this->catalogSession = $catalogSession;

        $this->customerSession = $customerSession;

        $this->resource = $resource;

        $this->Product = $Product;

        $this->ReviewCollectionFactory = $ReviewCollectionFactory;

        $this->StoreManagerInterface = $StoreManagerInterface;

        parent::__construct($context, $data);
    }

    public function getCustomerId(){
        $customer = $this->_customerSession->create();
        return $customer->getCustomer()->getId();
    }

    public function getPlaceholderImage(){
       
        return sprintf('<img src="%s"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg'));
    }

    public function getProduct()
    {
      //get values of current page. If not the param value then it will set to 1
       $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 10;
        //get values of current limit. If not the param value then it will set to 1
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 10;

        $data = $this->getRequest()->getParams();

        $ProductId = base64_decode($data['pid']);
                //get product review detail collection
        $product = $this->Product->create()->load($ProductId );

        //use load($producID) if you have product id
        $storeManager = $this->StoreManagerInterface;

        //Get Product Image
        if ($product->getImage()) {
            $imageUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
            $this->setProductImage($imageUrl);
        } else {
             $imageUrl = false;
             $this->setProductImage($imageUrl);
        }

        //Get Product url
        $ProductUrl = $product->getProductUrl();
        $this->setProductUrl($ProductUrl);
             
        $currentStoreId = $storeManager->getStore()->getId();

        $rating = $this->ReviewCollectionFactory;

        $collection = $rating->create()->addStoreFilter(
                            $currentStoreId
                        )->addStatusFilter(
                            \Magento\Review\Model\Review::STATUS_APPROVED
                        )->addEntityFilter(
                            'product',
                            $product->getId()
                        )->setDateOrder();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function _prepareLayout()
    {

        /*echo $mediaurl =  $this->StoreManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . 'ppp.png';*/


       parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Customer Review'));
        if ($this->getProduct()) {
            $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'magecomp.category.pager'
            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
            $this->getProduct()
            );
            $this->setChild('pager', $pager);
            $this->getProduct()->load();
        }
        return $this;

    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getRatingPercentArray($ProductId){
        $resource = $this->resource;
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('rating_option_vote'); 
        //Select Data from table
        $sql = "Select * FROM " . $tableName." WHERE entity_pk_value=".$ProductId;
        $result = $connection->fetchAll($sql);

        $RatingVoteArray = array();

        $RatingPercentArray = array();

        foreach ($result as $data) {

            $RatingPercentArray[$data['review_id']] = $data['percent'];
        }

        return $RatingPercentArray;
    }
}