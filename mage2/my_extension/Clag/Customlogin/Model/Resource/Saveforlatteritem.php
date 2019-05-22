<?php

namespace Clag\Customlogin\Model\Resource;

class Saveforlatteritem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('save_for_latter_item', 'item_id');
    }
}
