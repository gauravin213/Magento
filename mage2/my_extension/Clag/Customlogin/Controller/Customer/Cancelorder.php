<?php 
namespace Clag\Customlogin\Controller\Customer;  
class Cancelorder extends \Magento\Framework\App\Action\Action { 
  
 public function execute() { 
  
    $this->_view->loadLayout(); 
    $this->_view->renderLayout(); 
  } 
  
} 