<?php
 
namespace Clagtech\Clagmp\Controller\Index;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;     

class Adddata extends Action
{
    /** 
     * @var \Emipro\HelloWorld\Model\SampleFactory  
     */ 
    protected $_advertiseFactory;       
    /**     
     * @param Context $context  
     * @param SampleFactory $modelSampleFactory 
     */ 


    protected $_mediaDirectory;
    protected $_fileUploaderFactory;

    public function __construct
    (
        Context $context,
        \Clagtech\Clagmp\Model\ClagpostFactory $clagpostFactory,  
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Catalog\Model\ProductFactory $Product,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory, 
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        array $data = []
    ) 
    {   
        
        $this->_clagpostFactory = $clagpostFactory;

        $this->_messageManager = $messageManager;

        $this->Product = $Product;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;

        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;

        parent::__construct($context, $data);
    }

    public function execute()   
    {

        /**/
        $product = $this->_initProductSave();
        $ProductId = $product->getId();
        //var_dump($product->getData()); die();
        /**/

        $data = $this->getRequest()->getParams(); //echo "<pre>"; print_r($data); 

        $items = $this->_clagpostFactory->create();

        //$collection = $items->getCollection();  var_dump($collection->getData()); die();

        $collection = $items;
        $collection->setCustomerId($data['customer_id']);
        $collection->setProductId($ProductId);
        $collection->setTitle($data['title']);
        $collection->setUndertitle($data['undertitle']);
        $collection->setDescription($data['description']);
        $collection->setStatus(1);
        $collection->setQty($data['qty']);
        $collection->setPrice($data['price']);
        $collection->setCreatedAt(date("Y-m-d h:i:s"));
        $collection->save();

        //die();

        $this->_messageManager->addSuccessMessage('Your Product has been added successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('clagmp/index/index'));
    }


     protected function _initProductSave() {

        $data = $this->getRequest()->getParams();

        $Imagefillname = '/mycustomfolder/'.$data['image']; //die();

        $sku = str_replace(' ', '-', strtolower($data['title'])) . "_" . rand(100000000, 999999999);

        $product = $this->Product->create();
        $product->setName($data['title']);
        $product->setTypeId('simple');
        $product->setAttributeSetId(9);
        $product->setSku($sku);
        $product->setWebsiteIds(array(1));
        $product->setVisibility(4);
        $product->setPrice($data['price']);

        $product->setImage($Imagefillname);
        $product->setSmallImage($Imagefillname);
        $product->setThumbnail($Imagefillname);

        $product->setMediaGallery(array('images' => array(), 'values' => array())) 
        ->addImageToMediaGallery($Imagefillname, array('image', 'thumbnail', 'small_image'), FALSE, FALSE);

        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $category_id= array(3,5);
        $product->setCategoryIds($category_id); 
        $product->setTaxClassId(0);
        $product->setStockData(array(
                'use_config_manage_stock' => 0, //'Use config settings' checkbox
                'manage_stock' => 1, //manage stock
                'min_sale_qty' => 1, //Minimum Qty Allowed in Shopping Cart
                'max_sale_qty' => 2, //Maximum Qty Allowed in Shopping Cart
                'is_in_stock' => 1, //Stock Availability
                'qty' => $data['qty'] //qty
                )
            );

        //$productData = $this->productRepository->save($product);

        $product->save();

        //echo "==>".$product->getId();
        //var_dump($product->getData()); die();

        return $product;

     }


        
}