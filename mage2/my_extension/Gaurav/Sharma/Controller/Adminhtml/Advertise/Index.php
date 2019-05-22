<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Controller\Adminhtml\Advertise;

class Index extends \Gaurav\Sharma\Controller\Adminhtml\Advertise
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Gaurav_Sharma::sharma');
        $resultPage->getConfig()->getTitle()->prepend(__('Gaurav Advertise'));
        $resultPage->addBreadcrumb(__('Gaurav'), __('Gaurav'));
        $resultPage->addBreadcrumb(__('Advertise'), __('Advertise'));
        return $resultPage;
    }
}
