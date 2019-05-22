<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class MassDelete extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{

    public function execute()
    {
        $MassStatusIds = $this->getRequest()->getParam('id');  
        //echo "<pre>"; print_r($MassStatusIds); die();
	    if ($MassStatusIds) 
	    {
	    	foreach ($MassStatusIds as $id) 
	    	{
	        	$model = $this->_objectManager->create('Gaurav\Sharma\Model\Advertise');
		        $model->load($id);
		        $model->delete();
		    }
		    $this->messageManager->addSuccess(__('Your advertise delete successffully.'));
            $this->_redirect('gaurav_sharma/*/');
            return;
	    } 
	    else 
	    {
	    	$this->messageManager->addError(__('We can\'t find a id advertise to Status.'));
        	$this->_redirect('gaurav_sharma/*/');
	    }
    }
}
