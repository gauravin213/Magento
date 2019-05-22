<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */
namespace Gaurav\Sharma\Block\Adminhtml;

class Advertise extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'Advertise';
         $this->_blockGroup = 'Gaurav_Sharma';
        $this->_headerText = __('Advertise');
        $this->_addButtonLabel = __('Add New Advertise');
        parent::_construct();
    }
}
