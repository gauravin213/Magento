<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class NewAction extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
