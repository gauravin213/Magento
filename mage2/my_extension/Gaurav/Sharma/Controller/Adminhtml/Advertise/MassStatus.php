<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class MassStatus extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{

    public function execute()
    {
    	$status = $this->getRequest()->getParam('status');

        $row_ids = $this->getRequest()->getParam('id');  

        if ($status == 1) 
        {
        	//status enabled
        	$statusval = 1;
        } 
        else 
        {
        	//status disabled
        	$statusval = 0;
        }


	    if ($row_ids) 
	    {
	    	foreach ($row_ids as $id) 
	    	{
	        	$model = $this->_objectManager->create('Gaurav\Sharma\Model\Advertise');
		        $model->load($id);
		        $model->setStatus($statusval);
		        $model->save();
		    }
		    $this->messageManager->addSuccess(__('Your advertise status "enable" successffully.'));
            $this->_redirect('gaurav_sharma/*/');
            return;
	    } 
	    else 
	    {
	    	$this->messageManager->addError(__('We can\'t find a idvertise to Status.'));
        	$this->_redirect('gaurav_sharma/*/');
	    }
    }
}
