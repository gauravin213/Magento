<?php

namespace Gaurav\Sharma\Model\Resource;

class Advertise extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageclag_advertise', 'id');
    }
}
