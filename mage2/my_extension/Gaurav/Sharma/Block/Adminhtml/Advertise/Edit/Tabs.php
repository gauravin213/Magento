<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */
namespace Gaurav\Sharma\Block\Adminhtml\Advertise\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('gaurav_sharma_advertise_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Advertise'));
    }
}
