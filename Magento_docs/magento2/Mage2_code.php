https://webkul.com/blog/overriding-rewriting-classes-magento2/
http://www.dckap.com/blog/how-to-create-child-theme-in-magento2/
http://www.dckap.com/blog/how-to-add-remember-me-username-and-password-feature-in-magento-2/
https://www.mageplaza.com/how-get-data-shopping-cart-items-subtotal-grand-total-billing-shipping-address-magento-2.html

::https://www.mageplaza.com/kb/magento-2-tutorial/

<?php

->addFieldToFilter('customergroup', array('eq' => $categoryname))


// definr cunstructor in controller
protected $_customerSession;
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Customer\Model\Session $customerSession,
     array $data = []
    ) 
    {
        
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);

    }
echo $customer = $this->_customerSession->getCustomerId();


echo __('Create Backup')

?>


<?php
//get param
$data = $this->getRequest()->getParams();
?>


<?php
// add success message 
use Magento\Framework\Controller\ResultFactory;	
public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []) 
    {	
        parent::__construct($context, $data);
        $this->_messageManager = $messageManager;
    }

/*controller code*/
$this->_messageManager->addSuccessMessage('Your article "'.$data['title'].'" has been added successfully');
$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
$resultRedirect->setUrl($this->_redirect('helloworld/index/index'));
/*controller code*/
?>

<?php
//get Customer id
//https://developersushant.wordpress.com/2016/05/09/magento-2-get-logged-in-customer-details/
	$om = \Magento\Framework\App\ObjectManager::getInstance();

    $customerSession = $om->get('Magento\Customer\Model\Session');

    if($customerSession->isLoggedIn()) {

        echo "Customer Id : ".$customerSession->getCustomer()->getId()."<br/>";  
        echo "Name : ".$customerSession->getCustomer()->getName()."<br/>";  
        echo "Email : ".$customerSession->getCustomer()->getEmail()."<br/>"; 
        echo "Group Id : ".$customerSession->getCustomer()->getGroupId()."<br/>";  
      } 
?>


 <?php

                        $om = \Magento\Framework\App\ObjectManager::getInstance();

                        $customerSession = $om->get('Magento\Customer\Model\Session');

                        $storeManager = $om->get('\Magento\Store\Model\StoreManagerInterface');

                        $baseurl = $om->get('Magento\Store\Model\StoreManagerInterface')->getStore(0)->getBaseUrl();
                       
                        if($customerSession->isLoggedIn()) {

                            echo '<a href="'.$baseurl.'customer/account/logout">Logout</a>'; 
                        }
                        else{
                            echo '<a href="'.$baseurl.'customer/account/login">Login</a> / <a href="'.$baseurl.'customer/account/create">Register</a>'; 
                        }
                        ?>

<?php
// get media base url
$store = $this->StoreManagerInterface->getStore();
        echo $mideaBasewUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);


//get catalog product
$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
$productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
$productCollection->load();

var_dump($productCollection->getData());


$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
$productCollection = $objectManager->create('Magento\Catalog\Model\Product');
$productCollection->load(4);
echo "==>".$productCollection->getThumbnail();  echo "<br><br>";

echo "==>".$productCollection->getSmallImage();  echo "<br><br>";

echo "==>".$productCollection->getImage();  echo "<br><br>";

echo "==>".$productCollection->getProductUrl();
?>


<?php
//path
$obj = \Magento\Framework\App\ObjectManager::getInstance(); 
$dir = $obj->get('Magento\Framework\App\Filesystem\DirectoryList');

echo $dir->getPath('media').'/mycustomfolder/aa.jpg';
?>



 <?php
//get product image
$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
$product = $objectManager->create('Magento\Catalog\Model\Product');
$product->load(4);

 $store = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
$imageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();

echo $imageUrl;

 ?>




<?php
//sql query
https://webkul.com/blog/magento2-write-custom-mysql-query/
$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
$connection = $resource->getConnection();
$tableName = $resource->getTableName('employee'); //gives table name with prefix
 
//Select Data from table
$sql = "Select * FROM " . $tableName;
$result = $connection->fetchAll($sql); // gives associated array, table fields as key in array.
 
//Delete Data from table
$sql = "Delete FROM " . $tableName." Where emp_id = 10";
$connection->query($sql);
 
//Insert Data into table
$sql = "Insert Into " . $tableName . " (emp_id, emp_name, emp_code, emp_salary) Values ('','XYZ','ABD20','50000')";
$connection->query($sql);
 
//Update Data into table
$sql = "Update " . $tableName . "Set emp_salary = 20000 where emp_id = 12";
$connection->query($sql);
?>


<?php
//base murl
https://www.mageplaza.com/how-get-base-url-current-url-magento-2.html

namespace Mageplaza\HelloWorld\Block;
class HelloWorld extends \Magento\Framework\View\Element\Template
{
        protected $_storeManager;
        protected $_urlInterface;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlInterface,    
        array $data = []
    )
    {        
        $this->_storeManager = $storeManager;
        $this->_urlInterface = $urlInterface;
        parent::__construct($context, $data);
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    /**
     * Prining URLs using StoreManagerInterface
     */
    public function getStoreManagerData()
    {    
        echo $this->_storeManager->getStore()->getId() . '<br />';
        
        // by default: URL_TYPE_LINK is returned
        echo $this->_storeManager->getStore()->getBaseUrl() . '<br />';        
        
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_DIRECT_LINK) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_STATIC) . '<br />';
        
        echo $this->_storeManager->getStore()->getUrl('product/33') . '<br />';
        
        echo $this->_storeManager->getStore()->getCurrentUrl(false) . '<br />';
            
        echo $this->_storeManager->getStore()->getBaseMediaDir() . '<br />';
            
        echo $this->_storeManager->getStore()->getBaseStaticDir() . '<br />';    
    }
    
    /**
     * Prining URLs using URLInterface
     */
    public function getUrlInterfaceData()
    {
        echo $this->_urlInterface->getCurrentUrl() . '<br />';
        
        echo $this->_urlInterface->getUrl() . '<br />';
        
        echo $this->_urlInterface->getUrl('helloworld/general/enabled') . '<br />';
        
        echo $this->_urlInterface->getBaseUrl() . '<br />';
    }
    
}

/*phtml code*/
echo $block->getUrl('hello/test'); 

echo "<br><br><br><br><br>";

echo $block->getBaseUrl(); 
/*phtml code*/
?>



<?php
                        //$currentProduct = $this->getProduct();
                        $regularPrice = $product->getPriceInfo()->getPrice('regular_price');
                        ?>
                        <div class='price-box'>
                            <span class="price">
                                <?php
                                    echo $regularPrice->getMinRegularAmount().'-'.$regularPrice->getMaxRegularAmount();
                                ?>
                            </span>
                        </div>



<?php
// call blog
echo $this->getLayout()->createBlock('Gaurav\Sharma\Block\Navigation')->setTemplate("Navigation.phtml")->toHtml();
?>

<?php
//session
http://blog.chapagain.com.np/magento-2-set-unset-get-session/
?>


<?php
//update invetry

 $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        //Our sample values
        $sku = '100098';
        $stockValue = 5;

        $productRepository = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');
        $stockRegistry = $objectManager->create('Magento\CatalogInventory\Api\StockRegistryInterface');

        //Load product by SKU
        $product = $productRepository->get($sku);
        //Need to load stock item
        $stockItem = $stockRegistry->getStockItem($product->getId());
        $stockItem->setData('qty',$stockValue); //set updated quantity

        //$stockItem->setData('manage_stock',$stockData['manage_stock']);
        //$stockItem->setData('is_in_stock',$stockData['is_in_stock']);
        //$stockItem->setData('use_config_notify_stock_qty',1);

        $stockRegistry->updateStockItemBySku($sku, $stockItem);


\Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
\Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
/*inventry*/
        $stockItem=$this->_stockRegistry->getStockItem($data['product_id']); // load stock of that product
        //$stockItem->setData('is_in_stock',$stockData['is_in_stock']); 
        $stockItem->setData('qty', $data['qty']); 
        //$stockItem->setData('manage_stock',$stockData['manage_stock']);
        //$stockItem->setData('use_config_notify_stock_qty',1);
        $stockItem->save();
        /*inventry*/ 
?>

<?php
/*remove img*/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
         
        $product = $objectManager->create('Magento\Catalog\Model\Product')->load($data['product_id']);

        $productRepository = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');

        $existingMediaGalleryEntries = $product->getMediaGalleryEntries();

        foreach ($existingMediaGalleryEntries as $key => $entry) {
            //We can add your condition here
            unset($existingMediaGalleryEntries[$key]);
        }
        $product->setMediaGalleryEntries($existingMediaGalleryEntries);
        $productRepository->save($product);
        /*remove img*/

?>

<?php
// call block 
{{block class="Inchoo\Helloworld\Block\Helloworld" template="Inchoo_Helloworld::demo.phtml"}}

{{block class="Magento\\Cms\\Block\\Block" block_id="personal_basis_of_quality_and_Price"}}

{{block class="Inchoo\Helloworld\Block\Helloworld" template="demo.phtml"}}


echo $this->getLayout()->createBlock('Inchoo\Helloworld\Block\Helloworld')->setTemplate("demo.phtml")->toHtml();

echo $block->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId('womens_fragrances')->toHtml();

echo $this->getLayout()
        ->createBlock(
            'Magento\Framework\View\Element\Template', 
            '', 
            [
                'data' => [
                    'my_arg' => 'testvalue'
                ]
            ]
        )
        ->setTemplate("Magento_Checkout::reviewprogressbar.phtml")
        ->toHtml();

echo  $arg = $this->getData('my_arg'); echo "<br>";

echo $arg = $this->getMyArg(); echo "<br>";
            



 // pass url cms page 
 <a href="{{store url=""}}">Link to Base URL</a>
 <img src="{{media url="wysiwyg/parent-menu3.jpg"}}" alt="" />
?>

<?php echo $block->getUrl('hello/test'); echo "<br>"; ?>
 <?php echo $block->getBaseUrl(); ?>


/**/
//$_productCollection->addFieldToFilter('name', array('eq' => 'Product 3'));

//$productcollection = $_productCollection->addAttributeToSelect('*')->addAttributeToFilter('sku', 'Product 3')->load();

/*echo '<pre>';
print_r($_productCollection->getData());
echo "</pre>";*/
/**/

<!--custom search filter-->
    <form method="post" action="<?php echo $block->getUrl('clagmp/index/adddata');?>">
        <input type="text" name="custom_search_filter">
    </form>
    
    <!--custom search filter-->



<?php
/*
 * Get attribute info by attribute code and entity type
*/ 
$attributeCode = 'color';
$entityType = 'catalog_product';

$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

$attributeInfo = $objectManager->get(\Magento\Eav\Model\Entity\Attribute::class)
                               ->loadByCode($entityType, $attributeCode);

echo "<pre>";
print_r($attributeInfo->getData());

/**
 * Get all options name and value of the attribute
 */ 
$attributeId = $attributeInfo->getAttributeId();
$attributeOptionAll = $objectManager->get(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                                    ->setPositionOrder('asc')
                                    ->setAttributeFilter($attributeId)                                             
                                    ->setStoreFilter()
                                    ->load();

print_r($attributeOptionAll->getData());

//http://blog.chapagain.com.np/magento-2-get-attribute-id-name-value-from-attribute-code/
?>


<?php
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();


$reviewFactory = $objectManager->create('Magento\Review\Model\Review');
$storeId = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getId();


$product = $objectManager->create('Magento\Catalog\Model\Product');
$product->load(4);

//$reviewFactory->getEntitySummary($product, $storeId);

$ratingSummary = $product->getRatingSummary()->getRatingSummary();

$starrating5 = ($ratingSummary * 5)/100; 

$starrating4 = ($ratingSummary * 4)/100; 

$starrating3 = ($ratingSummary * 3)/100; 

$starrating2 = ($ratingSummary * 2)/100; 

$starrating1 = ($ratingSummary * 1)/100; 

?>


<div>
    <label><?php echo $starrating5;?>: </label>
    <progress value="<?php echo $starrating5;?>" max="100">
</div>


<div>
    <label><?php echo $starrating4;?>: </label>
    <progress value="<?php echo $starrating4;?>" max="100">
</div>


<div>
    <label><?php echo $starrating3;?>: </label>
    <progress value="<?php echo $starrating3;?>" max="100"> 
</div>

<div>
    <label><?php echo $starrating2;?>: </label>
    <progress value="<?php echo $starrating2;?>" max="100"> 
</div>

<div>
    <label><?php echo $starrating1;?>: </label>
    <progress value="<?php echo $starrating1;?>" max="100"> 
</div>


 <!--Review-->
            <?php
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $reviewFactory = $objectManager->create('Magento\Review\Model\Review');
            $storeId = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getId();

            $product = $objectManager->create('Magento\Catalog\Model\Product');
            $product->load($productId);

            $reviewFactory->getEntitySummary($product, $storeId);

            echo $ratingSummary = $product->getRatingSummary()->getRatingSummary();
            ?>

            <div class="product-reviews-summary short">
              <div class="rating-summary">
                 <span class="label"><span>Rating:</span></span>
                 <div class="rating-result" title="<?php echo $ratingSummary;?>%">
                     <span style="width:<?php echo $ratingSummary;?>%">
                         <span>
                             <span itemprop="ratingValue"><?php echo $ratingSummary;?></span>% of <span itemprop="bestRating">100</span>
                         </span>
                     </span>
                 </div>
             </div>

            </div>
            <!--Review-->



<?php
//get product review detail collection
$product = $objectManager->create("Magento\Catalog\Model\Product")->load(50);

//use load($producID) if you have product id
$storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
$currentStoreId = $storeManager->getStore()->getId();
$rating = $objectManager->get("Magento\Review\Model\ResourceModel\Review\CollectionFactory");

$collection = $rating->create()->addStoreFilter(
            $currentStoreId
        )->addStatusFilter(
            \Magento\Review\Model\Review::STATUS_APPROVED
        )->addEntityFilter(
            'product',
            $product->getId()
        )->setDateOrder();

 

echo "<pre>";
print_r($collection->getData()); //Get all review data of product
echo "</pre>";
?>


<?php 
//Wishlist
//echo $this->getBaseUrl();

//echo $this->getCurrentCurrencySymbol();

//echo "==>".$this->getPlaceholderImage();

$Wishlist_collection =  $this->getCollection();


/*echo "<pre>";
print_r($Wishlist_collection->getData());
echo "</pre>";*/

/* foreach ($Wishlist_collection as $item) {

    $Product = $this->Product->create()->load($item->getProduct()->getId());

    echo $item->getProduct()->getId();  echo "<br>";
    echo $item->getProduct()->getName();  echo "<br>";
    echo $item->getProduct()->getPrice();  echo "<br>";
    echo $item->getProduct()->getProductUrl();  echo "<br>";

    //echo $Product->getThumbnail(); echo "<br>";
    //echo $Product->getSmallImage(); echo "<br>";
    echo $Product->getImage(); echo "<br>";

    echo "<br><br>";
         

    //$wishlist = $this->_wishlistProviderInterface->getWishlist($item->getWishlistId());
    //$item->delete();
    //$wishlist->save();
}*/
?>


<?php
//flush cache

public function __construct(
    Context $context,
    \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
    \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
) {
    parent::__construct($context);
    $this->_cacheTypeList = $cacheTypeList;
    $this->_cacheFrontendPool = $cacheFrontendPool;
}

$types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
foreach ($types as $type) {
    $this->_cacheTypeList->cleanType($type);
}
foreach ($this->_cacheFrontendPool as $cacheFrontend) {
    $cacheFrontend->getBackend()->clean();
}
?>





<?php

Array ( [0] => canceled [1] => closed [2] => complete [3] => fraud [4] => fraud [5] => holded [6] => payment_review [7] => pending [8] => processing )

?>



<?php
/*Get all options by product id*/



$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();


$product = $_objectManager->get('\Magento\Catalog\Model\Product')->load(51);
echo $product->getName();


$customOptions = $_objectManager->get('Magento\Catalog\Model\Product\Option')->getProductOptionCollection($product);



$productTypeInstance = $_objectManager->get('Magento\ConfigurableProduct\Model\Product\Type\Configurable');
$productAttributeOptions = $productTypeInstance->getConfigurableAttributesAsArray($product);



//Get All options
$alloptArray = array();
foreach ($productAttributeOptions as $data) {
    $alloptArray[$data['attribute_code']] = $data['values'];
}

echo "<pre>";
print_r($alloptArray);




$typeInstance = $_objectManager->get('Magento\GroupedProduct\Model\Product\Type\Grouped');
         $childs = $typeInstance->getAssociatedProducts($product);



$store_id = $_storeManager->getStore()->getId();
            $options = $_objectManager->get('Magento\Bundle\Model\Option')
         ->getResourceCollection()
                          ->setProductIdFilter($product->getId())
                          ->setPositionOrder();
         $options->joinValues($store_id);
$typeInstance = $_objectManager->get('Magento\Bundle\Model\Product\Type');
$selections = $typeInstance->getSelectionsCollection($typeInstance->getOptionsIds($product), $product);

   
/*Get all options by product id*/






?>


<?php

/**/
$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();


/****/
$repository = $_objectManager->create('Magento\Catalog\Model\ProductRepository');
$product = $repository->getById('51');

$data = $product->getTypeInstance()->getConfigurableOptions($product);


$options = array();

foreach($data as $attr){
  foreach($attr as $p){

    if ($p['attribute_code'] == "homeopaths_enhancement") {
        
          $options[] = array(
            'sku'=>$p['sku'],
            'product_id'=>$p['product_id'],
            'attribute_code'=>$p['attribute_code'],
            'value_index'=>$p['value_index'],
            'super_attribute_label'=>$p['super_attribute_label'],
            'default_title'=>$p['default_title'],
            'option_title'=>$p['option_title'],
            'price'=>$repository->get($p['sku'])->getPrice()
        );
    }

    if ($p['attribute_code'] == "homeopaths_form") {
        
          $options[] = array(
            'sku'=>$p['sku'],
            'product_id'=>$p['product_id'],
            'attribute_code'=>$p['attribute_code'],
            'value_index'=>$p['value_index'],
            'super_attribute_label'=>$p['super_attribute_label'],
            'default_title'=>$p['default_title'],
            'option_title'=>$p['option_title'],
            'price'=>$repository->get($p['sku'])->getPrice()
        );
    }


  
  }
}


echo "<pre>";

print_r($options);

/*foreach($options as $sku =>$d){
  $pr = $repository->get($sku);
  foreach($d as $k => $v){
    echo $k.'____'.$v.'___'.$pr->getPrice(); echo "<br>";
  }
   
}*/
/****/


$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

$product = $_objectManager->get('\Magento\Catalog\Model\Product')->load(51);

$productTypeInstance = $_objectManager->get('Magento\ConfigurableProduct\Model\Product\Type\Configurable');

$productAttributeOptions = $productTypeInstance->getConfigurableAttributesAsArray($product);


/*echo "<pre>";
print_r($productAttributeOptions);*/


//Get All options
$alloptArray = array();
foreach ($productAttributeOptions as $data) {
    $alloptArray[$data['attribute_code']] = $data['values'];
}

/*foreach ($alloptArray['homeopaths_enhancement'] as $values) {
    echo $values['value_index']."___".$values['label']; echo "<br>";
}

foreach ($alloptArray['homeopaths_form'] as $values) {
    echo $values['value_index']."___".$values['label']; echo "<br>";
}*/
?>



<div class="recently-viewed-product">
    <?php echo $this->getLayout()->createBlock("Magento\Reports\Block\Product\Widget\Viewed")->setDisplayType("recently.view.products")->setProductsCount("5")->setTemplate("widget/viewed/content/viewed_list.phtml")->toHtml(); ?>
</div>



<?php
//get cart items

*echo "Saveforlatter controller";

        echo "<pre>";

        $quote = $this->_cartModel->getQuote();
        $cartAllItems = $quote->getAllItems();
        foreach ($cartAllItems as $item) {

            //print_r($item->getData());

            //print_r($item->getOptions());

            foreach ($item->getOptions() as $option) {

                echo "-->".$option['value']; echo "<br><br>";
                //echo "-->".unserialize($option['value']);

                //print_r(unserialize($option['value']));
               // $itemOptions = unserialize($option['value']);
                //itemOptions contain all the custom option of an item
            }
        }*/

        //print_r($itemOptions);


        /**/

        echo "<pre>";

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $storeId = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getId();

        $quoteItemCollection = $objectManager->create(\Magento\Quote\Model\ResourceModel\Quote\Item\Collection::class);

        $quote = $this->_cartModel->getQuote();

        $quote->setStoreId($storeId);

        $quoteItemCollection
            ->setQuote($quote)
            ->addFieldToFilter('product_id', 41); //51, 41, 
            //->addFieldToFilter('quote_id', 13);

        $newItem = $quoteItemCollection->getFirstItem();

       
        //print_r($newItem->getData());


        foreach ($newItem->getOptions() as $option) {


            print_r($option->getData());

            //echo "-->".$option['value'];  echo "<br><br>";
           // echo "-->".json_decode($option['value']); echo "<br><br>";

            //print_r(json_decode($option['value']));
            //break;

              
        }
?>




<?php 
$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
$quote = $objectManager->get('\Magento\Checkout\Model\Cart');
foreach ($product as $key) {
        $_product = '';
        $_product = $objectManager->create('\Magento\Catalog\Model\Product')->load(51);
        if($key['type']=='simple' || $key['type']=='virtual'){
            $params = array (
                'product' => $key['id'],
                'qty' => $key['qty']
            );
        } 
        if ($key['type']=='downloadable') {
            $params = array (
                'product' => $key['id'],
                'qty' => $key['qty'],
                'links' => $key['link']
            );
        } 
        if ($key['type']=='configurable') {
            $params = array (
                'product' => $key['id'],
                'qty' => $key['qty'],
                'super_attribute' => array('160'=>16, '161'=>26)
            );
        }
        $quote->addProduct($_product, $params);
    }
    $quote->save(); 

    ?>



<?php
//Get params
\Magento\Catalog\Block\Product\ListProduct $ListProduct,
\Magento\Wishlist\Helper\Data $wishlistHelper,
\Magento\Catalog\Helper\Product\Compare $comparetHelper,

'pid_base64_encode' => base64_encode($product->getId()),
'cartp' => $this->ListProduct->getAddToCartPostParams($product),
'wishlist' => $this->wishlistHelper->getAddParams($product),
'compare'=> $this->comparetHelper->getPostDataParams($product),


<div class="pp product-compare">
<a href='#' data-post='"+suggestion.compare+"' class='action towishlist' data-action='add-to-wishlist'>
<span>compare</span>
</a>
</div>

<div class="product-wishlist">
<a href='#' class='action towishlist actions-secondary' title='Add to Wish List' aria-label='Add to Wish List' data-post='"+suggestion.wishlist+"'  data-action='add-to-wishlist'>";
<span>Add to Wish List</span>
</a>
</div>

<div class="product-cart">';
<form data-role="tocart-form" action="'+suggestion.cartp['action']+'" method="post">
<input type="hidden" name="product" value="'+suggestion.cartp['data'].product+'">
<input type="hidden" name="uenc" value="'+suggestion.cartp['data'].uenc+'">
<?php echo $block->getBlockHtml('formkey')?>';
<button type="submit" title="<?php echo $block->escapeHtml(__('Add to Cart')); ?>" class="action tocart primary">
<span><?php echo __('Add to Cart') ?></span>
</button>
</form>
</div>



<div data-bind="html: custom_code_wishlist"></div>
                <div data-bind="html: custom_code_compare"></div>
?>



<?php
class SetCustomer
{
    protected $_customerFactory;
    protected $_addressFactory;

    public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Customer\Model\AddressFactory $addressFactory
    )
    {
        $this->_customerFactory = $customerFactory;
        $this->_addressFactory = $addressFactory;
    }

    //get customer model before you can get its address data
    $customer = $customerFactory->create()->load(1);    //insert customer id

    //billing
    $billingAddressId = $customer->getDefaultBilling();
    $billingAddress = $this->_addressFactory->create()->load($billingAddressId);
    //now you can update your address here and don't forget to save
    $billingAddress->save();

    //shipping
    $shippingAddressId = $customer->getDefaultShipping();
    $shippingAddress = $this->_addressFactory->create()->load($shippingAddressId);
    //now you can update your address here and don't forget to save
    $shippingAddress->save();
}



/****/
                /*$addresss = $this->_addressFactory;

                $address = $addresss->create();

                $address->setCustomerId($customer->getId());

                $address->setFirstname($userData['firstname']);

                $address->setLastname($userData['lastname']);

                $address->setCountryId('VN');

                $address->setPostcode('10000');

                $address->setCity('HaNoi');

                $address->setTelephone($userData['telephone']);

                $address->setFax('123456789');

                $address->setVatId('5555');

                $address->setCompany('company');

                $address->setStreet('aaaaaaaaaaaa');

                $address->setIsDefaultBilling('1');

                $address->setIsDefaultShipping('1');

                $address->setSaveInAddressBook('1');

                $address->save();*/
                /****/
?>














<?php
 /*
  * Get attribute info by attribute code and entity type
  */ 
$attributeCode = 'color';
$entityType = 'catalog_product';

$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

$attributeInfo = $objectManager->get(\Magento\Eav\Model\Entity\Attribute::class)
                               ->loadByCode($entityType, $attributeCode);

//var_dump($attributeInfo->getData()); exit;

/**
 * Get all options name and value of the attribute
 */ 
$attributeId = $attributeInfo->getAttributeId();
$attributeOptionAll = $objectManager->get(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                                    ->setPositionOrder('asc')
                                    ->setAttributeFilter($attributeId)                                             
                                    ->setStoreFilter()
                                    ->load();

//var_dump($attributeOptionAll->getData()); exit;
?>












<?php

namespace Clag\Customlogin\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * Upgrade data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.1', '<')) {
            $this->createMobileAttribute($setup);
        }
    }

    public function createMobileAttribute($setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        // Add new customer attribute
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'mobile',
            [

                'label'                 => 'Mobile',
                'input'                 => 'text',
                'required'              => false,
                'sort_order'            => 1000,
                'position'              => 1000,
                'visible'               => true,
                'system'                => false,
                'is_used_in_grid'       => true,
                'is_visible_in_grid'    => false,
                'is_filterable_in_grid' => false,
                'is_searchable_in_grid' => false,
                'default'               => '0'
            ]
        );

        // add attribute to form
        /** @var  $attribute */
        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'mobile');
        $attribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_create', 'customer_account_edit']);
        $attribute->save();

        $setup->endSetup();
    }
}
?>



<?php
namespace Clag\Customlogin\Setup;
 use Magento\Eav\Setup\EavSetup;
 use Magento\Eav\Setup\EavSetupFactory;
 use Magento\Framework\Setup\InstallDataInterface;
 use Magento\Framework\Setup\ModuleContextInterface;
 use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
 {
 private $eavSetupFactory;

public function __construct(EavSetupFactory $eavSetupFactory) {
 $this->eavSetupFactory = $eavSetupFactory;
 }
 
 public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context){
 $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 $eavSetup->removeAttribute(
 \Magento\Customer\Model\Customer::ENTITY,
 'mobile');
 }
 }
 ?>


<?php
//cron job path
php /home/govshop/public_html/mymagento/cron.php

php /home/-username-/public_html/-file path-
?>









//Remove sidbar account page
layout="1column"
<!-- Compare and wishlist sidebar -->
            <referenceBlock name="catalog.compare.sidebar" remove="true"/>
            <referenceBlock name="wishlist_sidebar" remove="true" />
            <!-- Recently order -->
            <referenceBlock name="sale.reorder.sidebar" remove="true" />
            <!-- additional sidebar block -->
            <referenceContainer name="sidebar.additional" remove="true" />










<div class="control qty">
   <input id="cart-<?= /* @escapeNotVerified */ $_item->getId() ?>-qty"
       name="cart[<?= /* @escapeNotVerified */ $_item->getId() ?>][qty]"
       data-cart-item-id="<?= /* @escapeNotVerified */ $_item->getSku() ?>"
       value="<?= /* @escapeNotVerified */ $block->getQty() ?>"
       type="number"
       size="4"
       title="<?= $block->escapeHtml(__('Qty')) ?>"
       class="input-text qty"
       data-validate="{required:true,'validate-greater-than-zero':true}"
       data-role="cart-item-qty"/>                                                     

      /*Code to add increment and decrement button*/

   <div class="qty_control">
            <button type="button"  id="<?= /* @escapeNotVerified */ $_item->getId() ?>-upt" class="increaseQty"></button>
            <button type="button"   id="<?= /* @escapeNotVerified */ $_item->getId() ?>-dec"  class="decreaseQty"></button>
      </div>
</div>

<script type="text/javascript">
require(["jquery"],function($){
    $('.increaseQty, .decreaseQty').on("click",function(){ 
        var $this = $(this);
        var ctrl = ($(this).attr('id').replace('-upt','')).replace('-dec','');          
        var currentQty = $("#cart-"+ctrl+"-qty").val();
        if($this.hasClass('increaseQty')){
            var newAdd = parseInt(currentQty)+parseInt(1);
             $("#cart-"+ctrl+"-qty").val(newAdd);
        }else{
             if(currentQty>1){
                var newAdd = parseInt(currentQty)-parseInt(1);
                $("#cart-"+ctrl+"-qty").val(newAdd); 
             }
        }
    });
});
</script>






/***********checkout observer*************/
<event name="checkout_onepage_controller_success_action">
        <observer name="mageplaza_osc_controller_success_action" instance="Mageplaza\Osc\Observer\Convertguest"  />
</event>


<?php
  
namespace Mageplaza\Osc\Observer;
 
class Convertguest implements \Magento\Framework\Event\ObserverInterface {
 
    protected $_logger;
    protected $_orderFactory; 
    protected $accountManagement;
    protected $_objectManager;
    protected $orderCustomerService;
 
    public function __construct(        
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        \Magento\Sales\Api\OrderCustomerManagementInterface $orderCustomerService,
        \Magento\Framework\ObjectManager\ObjectManager $objectManager
    ) {
 
        $this->_logger = $loggerInterface;
        $this->_orderFactory = $orderFactory;
        $this->accountManagement = $accountManagement;
        $this->orderCustomerService = $orderCustomerService;
        $this->_objectManager = $objectManager;
 
 
    }
 
    public function execute(\Magento\Framework\Event\Observer $observer ) { 
 
        $orderIds = $observer->getEvent()->getOrderIds();
        $orderdata =array();
        if (count($orderIds)) {
 
            $orderId = $orderIds[0];
            $order = $this->_orderFactory->create()->load($orderId);
 
            /*Convert guest to customer*/
            if ($order->getEntityId() && $this->accountManagement->isEmailAvailable($order->getEmailAddress())) {
                $this->orderCustomerService->create($orderId);
 
            }
            /*END*/
 
        }
 
    }



}

/***********checkout observer*************/



public function reindexAll() {

    $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $indexerFactory = $this->_objectManager->get('Magento\Indexer\Model\IndexerFactory');
    $indexerIds = array(
        'catalog_category_product',
        'catalog_product_category',
        'catalog_product_price',
        'catalog_product_attribute',
        'cataloginventory_stock',
        'catalogrule_product',
        'catalogsearch_fulltext',
    );
    foreach ($indexerIds as $indexerId) {
        echo " create index: ".$indexerId."\n";
        $indexer = $indexerFactory->create();
        $indexer->load($indexerId);
        $indexer->reindexAll();
    }

}