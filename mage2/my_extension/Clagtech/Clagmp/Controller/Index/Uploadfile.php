<?php
 
namespace Clagtech\Clagmp\Controller\Index;  

use Magento\Framework\App\Action\Action;        
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;     

class Uploadfile extends Action
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
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory, 
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        array $data = []
    ) 
    {   
        
        $this->_clagpostFactory = $clagpostFactory;

        $this->_messageManager = $messageManager;

        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;

        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;

        parent::__construct($context, $data);
    }

    public function execute()   
    {
        //$data = $this->getRequest()->getParams(); echo "<pre>"; print_r($data);  die("Uploadfile!!");

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') 
        {
            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            try{
                $target = $this->_mediaDirectory->getAbsolutePath('mycustomfolder/');        
                /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                $uploader = $this->_fileUploaderFactory->create(['fileId' => 'file']);
                /** Allowed extension types */
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc']);
                /** rename file name if already exists */
                $uploader->setAllowRenameFiles(true);
                /** upload file in folder "mycustomfolder" */
                $result = $uploader->save($target);
                if ($result['file']) {

                    die($result['file']);
                    //$this->messageManager->addSuccess(__('File has been successfully uploaded')); 
                }
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
            return $this->resultRedirectFactory->create()->setPath(
                '*/*/upload', ['_secure'=>$this->getRequest()->isSecure()]
            ); 


        }


    }



        
}