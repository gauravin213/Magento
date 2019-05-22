<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Clag\Customlogin\Model\Resource\Saveforlatteritem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Clag\Customlogin\Model\Saveforlatteritem', 'Clag\Customlogin\Model\Resource\Saveforlatteritem');
    }
}
