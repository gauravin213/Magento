<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class Edit extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Gaurav\Sharma\Model\Advertise');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This advertise no longer exists.'));
                $this->_redirect('gaurav_sharma/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_gaurav_sharma_advertise', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('advertise_advertise_edit');
        $this->_view->renderLayout();
    }
}
