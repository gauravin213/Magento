<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class Delete extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Gaurav\Sharma\Model\Advertise');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the item.'));
                $this->_redirect('gaurav_sharma/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete item right now. Please review the log and try again.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_redirect('gaurav_sharma/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a idvertise to delete.'));
        $this->_redirect('gaurav_sharma/*/');
    }
}
