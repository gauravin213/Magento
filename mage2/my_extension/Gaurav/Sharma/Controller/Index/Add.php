<?php
 
namespace Gaurav\Sharma\Controller\Index;
 
use Magento\Framework\App\Action\Action;

class Add extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}