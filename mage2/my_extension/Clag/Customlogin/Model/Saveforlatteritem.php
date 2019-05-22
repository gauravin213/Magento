<?php
namespace Clag\Customlogin\Model;

class Saveforlatteritem extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Clag\Customlogin\Model\Resource\Saveforlatteritem');
    }
}
