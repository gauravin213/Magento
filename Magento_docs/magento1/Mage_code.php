//tab reference //http://www.eglobeits.com/blog/magento-admin-module-development-with-grid-and-tab/

<?php
Mage::getSingleton(‘core/session’)->addNotice(‘Notice message’);
Mage::getSingleton(‘core/session’)->addSuccess(‘Success message’); 
Mage::getSingleton(‘core/session’)->addError(‘Error message’);
Mage::getSingleton(‘adminhtml/session’)->addWarning(‘Warning message’); 



require_once(Mage::getModuleDir('controllers','Mage_Tag').DS.'TagController.php');
Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);


<a href="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/base/default/marketplace/js/jquery.tmpl.min.js'; ?>" target="_blank">Link</a> 

$url = Mage::getUrl('module/controller/action', array('param1'=>'val1', '_query'=>array('p1'=>'v1', 'p2'=>'v2')));

$url = 'faq/index/faqcontent/?faqid=23';
$this->_redirect($url);

$redirectUrl = 'faqcontent/?faqid=23';
Mage::app()->getResponse()->setRedirect($redirectUrl);
?>

<?php
//encode decode
<a href="<?php echo Mage::getBaseUrl().'orderlist/order/editpurchaseveryf/id/'.base64_encode($advertise->getId()); ?>"><i class="fa fa-pencil-square-o actionicon" aria-hidden="true"></i></a>
$id = base64_decode($this->getRequest()->getParam('id')); 
?>

<?php echo $this->__('hello world FQA') ?>

<?php
//--set broswser tab title
$this->getLayout()->getBlock('head')->setTitle(Mage::helper('wkbidding')->__('shipment'));
?>


<a href="<?php echo Mage::getBaseUrl(). 'bankaccount/index/bankedit/?customerid='.$bankid; ?>"></a>

<a href="<?php echo Mage::getBaseUrl(). 'customer/account/loginPost'; ?>"></a>
<a href="<?php echo Mage::getBaseUrl().'marketplace/seller/emailverification'; ?>" >ajax  code testing </a>


<img src="<?php echo Mage::getBaseUrl(). '/skin/frontend/smartwave/porto/img/area-6cde42783148745bc07bc4233648acbb.png'; ?>" alt="map" width="692" height="492" usemap="#map" >

<img src="<?php echo Mage::getBaseUrl(). '/skin/frontend/smartwave/porto/img/25472601-none.gif'; ?>" alt="map" width="692" height="492" usemap="#map" >

<?php

	$tableData = Mage::getModel('advertise/advertise')->getCollection();

	 echo "<pre>";
	  print_r($tableData->getData());
	 foreach($tableData as $r)
	 {
	    echo $r->getProduct_id().'<br>';
	    echo $r->getRegion().'<br>';
	 }
	//die();
?>

<?php
// get table name
echo Mage::getSingleton('core/resource')->getTableName('mycards/mycards');
?>

<script type="text/javascript">
	function getChild(id)
    {
    	//alert(id);
    	 jQuery.ajax({
            type: 'POST',
            url: '<?php echo $this->getUrl('advertise/advertise/geographyadvertise') ?>',
            data: {cid: id},
            dataType: 'html',
            success: function (result) {
                jQuery("").html(result);
            }
            
        });

    }
	</script>


<?php
[Region] => $Schaffhausen;


$_productCollection1 = $this->getLoadedProductCollection();


$outputMessage = Mage::getSingleton('core/session')->getWelcomeMessage();


Mage::getSingleton('core/session')->unsWelcomeMessage();
$collection = $_productCollection1->addAttributeToFilter('entity_id', array('in' => $outputMessage));
$_productCollection11 = $collection;

?>



/*get attribute code valuse by this way */
<?php
	echo "<pre>";

	$model = Mage::getModel('catalog/resource_eav_attribute')->load('state', 'attribute_code');
	$options = $model->getSource()->getAllOptions(false);
	$optionsd = array_column($options, 'label');
	print_r($options);

	die();
?>


<?php
	$tableData = Mage::getModel('advertise/advertise')->getCollection()
					->addFieldToSelect('region');
	    $tableData->getSelect()->group('region');

		 foreach($tableData as $r)
		 { 
	?>
		   <li>
				<!--<a id="area1_link" class="map-link" rel="#area1" data-ca="Aargau" href="<?php //echo Mage::getBaseUrl().'advertise/advertise/geographyadvertise'; ?>?region=<?php //echo $r->getRegion(); ?>">
					<strong><?php //echo $r->getRegion(); ?></strong>
				</a>-->

				<a href="<?php echo Mage::getBaseUrl().'advertise.html?state=2716'; ?>">Test</a>

				<a href="<?php echo Mage::getBaseUrl().'marketplace/seller/regapprove/'; ?>">Test2017</a>

<a href="https://www.hashnet.ch/marketplace/seller/regapprove">Test2017</a>

			</li>
	<?php 
	}	
	?>	

<?php
<a href="<?php echo Mage::getBaseUrl().'sharing-article.html?state=2699'; ?>">Test</a>
?>


<?php echo Mage::helper('advertise')->__('Aargau');?>

  <li class="ch3"><a href="<?php echo Mage::getBaseUrl().'advertise.html?state=2695'; ?>">Appenzell[AI]</a></li>
?>

<?php
$_productCollection = $this->getLoadedProductCollection()->addAttributeToFilter('status', array('eq' => 1));
$collectionamount = Mage::getModel('wkbidding/mpbiddingamount ')->getCollection()->addFieldToFilter('status',1);
?>

<?php
$collectionbidam = Mage::getModel('wkbidding/mpbiddingamount');
$collectionbidam->load($bidid, 'bid_id');

$collectionbidam->setCurrent_bid($bidamt);
$collectionbidam->save();

echo "Current_bid :".$collectionbidam->getCurrent_bid()."<br/>";
?>

/*************************************************************************************/
add page in catelog
<reference name="root">
            <action method="setTemplate">
                <template>page/1column.phtml</template>
            </action>
 </reference>
<reference name="category.products">
<block type="catalog/product_list" name="product_list" template="catalog/product/geography.phtml"></block>
</reference>
/************************************************************************************/


<?php
$bankData = $this->getRequest()->getPost();
$wholedata = $this->getRequest()->getParams();


/*query string*/
<a class="aa" href="<?php echo Mage::getUrl('orderlist/order/purchase', array('_current' => true, '_use_rewrite' => true, '_query' => array('payment_type' => 'OutstandingPayments'))); ?>">
/**/
      
 echo $current_bid_price = $wholedata['currentbid']."<br>"; 
 echo $max_bid = $wholedata['bidding_amount'] ."<br>"; 

 			$collectionupdate=Mage::getModel('wkbidding/mpbiddingamount')->getCollection();
            $collectionupdate->addFieldToFilter('customer_id',array('eq' => $wholedata['customer_id']));
            $collectionupdate->addFieldToFilter('bid_id',array('eq' => $wholedata['bid_id']));
            $collectionupdate->addFieldToFilter('status',array('eq' => '1'));
            
            foreach($collectionupdate as $ki){
                $ki->setCurrentbid($wholedata['currentbid']);
                $ki->save();
            }
?>

<?php
Mage::getSingleton('core/session')->addSuccess("Your activation code is not activated");
$this->_redirect('wkbidding/index/activatecode/');
?>

<?php
try 
		{
	       	$bankData = $this->getRequest()->getPost();
		 	$bankcollection = Mage::getModel('bankaccount/batchbank')->setData($bankData);
		 	$bankcollection->save();
		 	Mage::getSingleton('core/session')->addSuccess("Successfully save bank data");
	        $this->_redirect('bankaccount/index/bankcreate/');

        } 
        catch (Exception $e) 
        {
           Zend_Debug::dump($e->getMessage());
           Mage::getSingleton('core/session')->addError($e->getMessage());
           die("error");
        }
?>

<?php
$bankc = Mage::registry('current_customer')->getId();
?>



<?php
 if(Mage::getSingleton('customer/session')->isLoggedIn()) {
     $customerData = Mage::getSingleton('customer/session')->getCustomer();
      echo $customerData->getId();
 }

 $userId = Mage::getSingleton('customer/session')->getCustomer()->getId();
?>



<?php

$inputMessage = 'Hello World';
Mage::getSingleton('core/session')->setWelcomeMessage($inputMessage);

$outputMessage = Mage::getSingleton('core/session')->getWelcomeMessage();
echo $this->__($outputMessage);


Mage::getSingleton('core/session')->unsNewCustomerData();
?>



<?php
/*region by region id*/  
$region = Mage::getModel('directory/region')->load($address['region_id']);
echo $state_name = $region->getName()."<br>"; //California

?>

<?php
/*get lable values by attribute code*/
$attributeId = Mage::getResourceModel("eav/entity_attribute")
  ->getIdByCode("catalog_product","state");
$attribute = Mage::getModel("catalog/resource_eav_attribute")->load($attributeId);
$attributeOptions = $attribute ->getSource()->getAllOptions();

/*echo "<pre>";
print_r($attributeOptions);*/

foreach ($attributeOptions as $key) {
   echo "--".$key['value']."<br>";
   echo "--".$key['label']."<br><br>";
}
die();

?>


<?php	
$addressesCollection = Mage::getResourceModel('customer/address_collection');
$addressesCollection->addAttributeToSelect('*');
$addressesCollection->addFieldToFilter('parent_id',array('eq' => 533));
echo "<pre>"; 
foreach ($addressesCollection as $address) {
  //print_r($address->getData());
  //echo $address['region_id']."<br>";


  	$region = Mage::getModel('directory/region')->load($address['region_id']);
	echo $state_name = $region->getName()."<br>"; //California


}
die();
?>


<?php
/*get product url
http://magento.stackexchange.com/questions/10200/efficient-get-product-url-from-id
*/

/**/
echo $productId = $_item->getProduct_id();
$product_collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToFilter('entity_id', $productId)
                ->addUrlRewrite();
$product_collection_url = $product_collection->getFirstItem()->getProductUrl();
echo $product_collection_url;
/**/
?>

<?php
$collection1 = Mage::getModel('advertise/advertise')->getCollection();
        $collection1->getSelect()->join(
            'mage_clag_advertise_details',
            'main_table.product_id = mage_clag_advertise_details.product_id'
            )
        ->group("mage_clag_advertise_details.product_id");
?>


<?php  /*get catalog/product image*/
$product = Mage::getModel('catalog/product')->load($productId);
$productMediaConfig = Mage::getModel('catalog/product_media_config');
$smallImageUrl = $productMediaConfig->getMediaUrl($product->getSmallImage());
echo $smallImageUrl."<br>";
?>


<?php
/*--call inchoo block--*/
echo $this->getLayout()->createBlock('inchoo_socialconnect/google_button')->setTemplate("inchoo/socialconnect/google/button.phtml")->toHtml();

echo $this->getLayout()->createBlock('inchoo_socialconnect/facebook_button')->setTemplate("inchoo/socialconnect/facebook/button.phtml")->toHtml();
?>


<?php
/*registery*/
Mage::register('Productggg_idd', $t_id);
?>

<?php
//get current date time
Mage::getModel('core/date')->date('Y-m-d H:i:s');
?>

<?php
//number formate
echo 'CHF ' . number_format($minprice + $increment, 2, '.', "'");
?>

<?php

//add etid btn admin area adminhtml
$this->addColumn('action', array(
            'header' => Mage::helper('sharing')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => $this->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

//add status in grid.php file
protected function _prepareMassaction()
  {

        $this->setMassactionIdField('purchaselist_purchase_id');
        $this->getMassactionBlock()->setFormFieldName('purchaselist_purchase_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('advertise')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('advertise')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('advertise/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('advertise')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('advertise')->__('Status'),
                    'values' => array(
                            array('value' => '', 'label' => ''), 
                            array('value' => '1', 'label' => 'approved'), 
                            array('value' => '0', 'label' => 'Unapproved')
                          )
                )
            )
        ));
        return $this;
  }


//add code controller
public function massStatusAction()
    {

        $mpbiddingaddonsIds = $this->getRequest()->getParam('purchaselist_purchase_id');
        $status = $this->getRequest()->getParam('status');
         if ($status == 1) {
            $prstatus = "Approved";
        } else {
            $prstatus = "Unapproved";
        }


        $purchasCollection = Mage::getModel('advertise/purchaselist')
        ->load($mpbiddingaddonsIds);
        $purchasCollection->setPurchase_status($prstatus);
        $purchasCollection->save();


        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('successfully', count($mpbiddingaddonsIds)));

        $this->_redirect('*/*/index');
    }
?>



<?php
//checkout url
//http://inchoo.net/magento/programatically-add-bundle-product-to-cart-n-magento/

$params = array(
    'product' => 164,
    'related_product' => null,
    'bundle_option' => array(
        21 => 58,
        20 => 55,
        11 => 28,
        12 => array(
            0 => 31,
        ),
        13 => array(
            0 => 32,
            1 => 35,
        ),
    ),
    'options' => array(
        3 => 'olaaaaaaaa',
    ),
    'qty' => 2,
);
 
$cart = Mage::getSingleton('checkout/cart');
 
$product = new Mage_Catalog_Model_Product();
$product->load(164);
 
$cart->addProduct($product, $params);
$cart->save();
 
Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
 
$message = $this->__('Custom message: %s was successfully added to your shopping cart.', $product->getName());
Mage::getSingleton('checkout/session')->addSuccess($message);

?>

http://magento.stackexchange.com/questions/85532/magento-bypass-checkout-for-free-products


<?php
//get qty
    $products = Mage::getModel('catalog/product')
     ->getCollection()
     ->addFieldToFilter('entity_id',array('eq' => $product_id))
     ->addAttributeToSelect('*')
     ->joinField('qty',
                 'cataloginventory/stock_item',
                 'qty',
                 'product_id=entity_id',
                 '{{table}}.stock_id=1',
                 'left');

     echo "<pre>";
        print_r($products->getData());
?>



<?php
//--get category
/**/
$product = Mage::getModel('catalog/product')->load(427523);
$cats = $product->getCategoryIds();

//echo "<pre>";
//print_r($cats);

foreach ($cats as $category_id) {
    $_cat = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($category_id);
        $Catname[] = $_cat->getName();  echo "<br>";           
}

//print_r($Catname); echo "<pre>";

echo $Catname['2']." > ".$Catname['3']." > ".$Catname['4']." > ".$Catname['5'];

//print_r($product->getData());
/**/

/*--getcategory id--*/
$product = Mage::getModel('catalog/product')->load($_product->getId());
$cats = $product->getCategoryIds();
end($cats);
$z = "category/".prev($cats)."/";
/*--getcategory id--*/

/*--getcategory id--*/
$_helper = Mage::helper('catalog/category');
$_categories = $_helper->getStoreCategories();
if (count($_categories) > 0){
    foreach($_categories as $_category){
        $_category = Mage::getModel('catalog/category')->load($_category->getId());
        $_subcategories = $_category->getChildrenCategories();
        if (count($_subcategories) > 0){
            //echo $_category->getName();
            $catids_array[] = $_category->getId();     
            foreach($_subcategories as $_subcategory){
                 //echo $_subcategory->getName();
                $catids_array[] = $_subcategory->getId();
            }
        }
    }
}

echo "<pre>";
print_r($catids_array);
/*--getcategory id--*/

/*--get product without category--*/
$catIdArray = array(1,2,5090,15986,22901,22912,22913,4363,6137,8699,8302,4457,22908,22911,23198,23197,23204,23225,23205,23243,23256,23274,23278); //categories ids
        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*');
              
    $collection->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left');
    $collection->joinField('websites', 'catalog/product_website', 'website_id', 'product_id=entity_id', null, 'left');
   $collection->joinField( 'category_id','catalog/category_product','category_id','product_id=entity_id', null, 'left')
->addAttributeToFilter('category_id', array('nin' => $catIdArray));
        
        $collection->getSelect()->group('entity_id')->distinct(true);

//------------------------------------------------------------------------
//link https://magento.stackexchange.com/questions/57717/how-to-get-product-ids-of-specific-category-and-not-in-other-categories-in-magen
$catIds = array(4);
$notCatIds = array(3, 10);
$productCollection = Mage::getResourceModel('catalog/product_collection')
    ->setStoreId(0)
    ->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id=entity_id', null, 'left')
    ->addAttributeToFilter('category_id', array('in' => $notCatIds))
    ->addAttributeToFilter('category_id', array('in' => $catIds))
    ->addAttributeToFilter('category_id', array('nin' => $notCatIds))
    ->addAttributeToFilter('category_id', array('nin' => array(2)))// 2 is default category id
    ->addAttributeToSelect('*');
$productCollection->getSelect()->group('product_id')->distinct(true);

echo '<pre>';
print_r($productCollection->getData());

/*--get product without category--*/

?>


<?php
cms block

<a title="Cabinet Vanities" href="{{store url=""}}bathroom-fixtures-orlando-fl/bathroom-vanities-orlando-fl/furniture-vanities-orlando-fl/traditional-furniture-vanities"> 

?>


<?php
//update price
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
?>


<?php
//get$this->getLoadedProductCollection(); or this below are same
$filter = '';
$filter_prostatus = '';
$_productCollection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('name', array('like' => "%" . $filter . "%"));
        if ($filter_prostatus) {
            $_productCollection->addFieldToFilter('status', array('like' => "%" . $filter_prostatus . "%"));
        }
            $_productCollection->addFieldToFilter('status', array('eq' => "1" ));
            

        $_productCollection
//                ->addFieldToFilter('created_at', array('datetime' => true, 'from' => $from, 'to' => $to))
                ->addFieldToFilter('entity_id', array('in' => $products))
                ->setOrder('entity_id', 'DESC')->getSelect()->limit(10);
?>


<?php
//evenr observer
https://magento.stackexchange.com/questions/8043/apply-an-extra-filter-in-view

<frontend>   
       <events>
            <catalog_product_collection_load_before>
                <observers>
                    <ssd_ajaxify>
                        <class>SSD_Ajaxify_Model_Observer</class>
                        <method>catalogProductCollectionLoadBefore</method>
                    </ssd_ajaxify>
                </observers>
            </catalog_product_collection_load_before>
        </events>
</frontend>

class SSD_Ajaxify_Model_Observer
{    
public function catalogProductCollectionLoadBefore($observer)
        {
            $request = Mage::app()->getRequest();
            $path    = implode('_', array(
                $request->getModuleName(),
                $request->getControllerName(),
                $request->getActionName(),
            ));
            if ($path == 'catalog_category_view') {
                $collection = $observer->getEvent()->getCollection();
                $collection->addAttributeToFilter('price', array('gt'=> 50));
            }
        }
}


jQuery('#my-orders-table > tfoot > tr').each( function(index){
                 jQuery(this).addClass('clag'+ index);
           });



<?php
//sql query
$read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $result = $read->query("SELECT customer_id,amount_id FROM mage_marketplace_mpbidding_amount WHERE currentbid IN (SELECT max( currentbid ) FROM mage_marketplace_mpbidding_amount WHERE bid_id =$wholedata[bid_id]) && bid_id =$wholedata[bid_id]");
        $row = $result->fetch();
        //print_r($row);
        $customertopid = $row['customer_id'];
        $amount_ids = $row['amount_id'];
?>


<?php
// add to card
 $cart       = Mage::getSingleton('checkout/cart');
                $product = Mage::getModel('catalog/product')->load($item['product_id']);
                $cart->addProduct($product, 1);
                $cart->save();
?>

<?php 
// get form key
echo Mage::getSingleton('core/session')->getFormKey();

echo $this->getBlockHtml('formkey'); 
?>

<?php
//grid row count
http://ka.lpe.sh/2012/01/05/magento-wrong-count-in-admin-grid-when-using-group-by-clause-overriding-lib-module/
?>