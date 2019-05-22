<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Gaurav\Sharma\Model\Resource\Advertise;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Gaurav\Sharma\Model\Advertise', 'Gaurav\Sharma\Model\Resource\Advertise');
    }
}
