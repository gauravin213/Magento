<?php
 
namespace Clagtech\Clagmp\Controller\Index;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;     

class Editdata extends Action
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
        \Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry, 
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

        $this->_stockStateInterface = $stockStateInterface;
        $this->_stockRegistry = $stockRegistry;

        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;

        parent::__construct($context, $data);
    }

    public function execute()   
    {

        $data = $this->getRequest()->getParams(); 

        $product = $this->_initProductSave();

        $ProductId = $product->getId();
    
        $items = $this->_clagpostFactory->create()->load($data['edit_id']);

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

        $this->_messageManager->addSuccessMessage('Your Product has been update successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('clagmp/index/index'));
    }


     protected function _initProductSave() {

        $data = $this->getRequest()->getParams(); 

        $Imagefillname = '/mycustomfolder/'.$data['image']; 

        $sku = str_replace(' ', '-', strtolower($data['title'])) . "_" . rand(100000000, 999999999);

        $product = $this->Product->create()->load($data['product_id']);
        $product->setName($data['title']);
        $product->setTypeId('simple');
        $product->setAttributeSetId(9);
        $product->setWebsiteIds(array(1));
        $product->setVisibility(4);
        $product->setPrice($data['price']);

         if ($data['image']) { 

        /*remove img*/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
         
        $productimg = $objectManager->create('Magento\Catalog\Model\Product')->load($data['product_id']);

        $productRepository = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');

        $existingMediaGalleryEntries = $productimg->getMediaGalleryEntries();

        foreach ($existingMediaGalleryEntries as $key => $entry) {
            //We can add your condition here
            unset($existingMediaGalleryEntries[$key]);
        }
        $productimg->setMediaGalleryEntries($existingMediaGalleryEntries);
        $productRepository->save($productimg);
        /*remove img*/


        $product->setImage($Imagefillname);
        $product->setSmallImage($Imagefillname);
        $product->setThumbnail($Imagefillname);
        $product->setMediaGallery(array('images' => array(), 'values' => array())) 
        ->addImageToMediaGallery($Imagefillname, array('image', 'thumbnail', 'small_image'), FALSE, FALSE);
        }

        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $category_id= array(3,5);
        $product->setCategoryIds($category_id); 
        $product->setTaxClassId(0);

        $stockItem=$this->_stockRegistry->getStockItem($data['product_id']); 
        $stockItem->setData('qty', $data['qty']); 
        $stockItem->save();
        $product->save();

    
        return $product;

     }


        
}