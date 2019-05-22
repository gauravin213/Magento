<?php
 
namespace Clagtech\Clagmp\Controller\Index;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;     

class Restoredata extends Action
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

        $data = $this->getRequest()->getParams('id');   var_dump($data);

        $items = $this->_clagpostFactory->create()->load($data['id']);

        $collection = $items;
        $collection->setStatus(0);
        $collection->setTrash(0);
        $ProductId = $collection->getProductId();
        $collection->save();

        //echo $ProductId;

        $product = $this->Product->create()->load($ProductId);
        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $product->save();

        /*var_dump($collection->getData()); 
        var_dump($product->getData());
        die();*/


        $this->_messageManager->addSuccessMessage('Your Product has been restored successfully');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect('clagmp/index/index'));
    }



        
}