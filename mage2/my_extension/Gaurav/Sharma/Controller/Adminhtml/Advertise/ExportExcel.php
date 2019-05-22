<?php

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class ExportExcel extends \Magento\Backend\App\Action
{

  protected $_fileFactory;
  protected $resultPageFactory;
  public function __construct
  ( 
    \Magento\Backend\App\Action\Context  $context,
    \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    \Magento\Framework\App\Response\Http\FileFactory $fileFactory
  ) 
  {
    $this->resultPageFactory  = $resultPageFactory;

    $this->_fileFactory  = $fileFactory;

    parent::__construct($context);
  }

  public function execute()
    {
     
        $fileName = 'sharma.xls';
        $content = $this->_view->getLayout()->createBlock(
            'Gaurav\Sharma\Block\Adminhtml\Advertise\Grid'
        )->setSaveParametersInSession(
            true
        )->getExcel();
        return $this->_fileFactory->create($fileName, $content);
    }
    
}