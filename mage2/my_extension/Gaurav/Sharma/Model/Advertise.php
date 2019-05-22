<?php
namespace Gaurav\Sharma\Model;

class Advertise extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Gaurav\Sharma\Model\Resource\Advertise');
    }
}
