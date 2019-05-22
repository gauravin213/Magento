<?php
namespace Clagtech\Clagmp\Block\Adminhtml;

class Clagpost extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_clagpost';
        $this->_blockGroup = 'Clagtech_Clagmp';
        $this->_headerText = __('Clagpost');
        $this->_addButtonLabel = __('Create New Clagpost');
        parent::_construct();
    }
}
