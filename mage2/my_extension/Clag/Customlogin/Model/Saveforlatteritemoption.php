<?php
namespace Clag\Customlogin\Model;

class Saveforlatteritemoption extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Clag\Customlogin\Model\Resource\Saveforlatteritemoption');
    }
}
