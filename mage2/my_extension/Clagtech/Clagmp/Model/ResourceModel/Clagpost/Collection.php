<?php
/**
 * Mageplaza_HelloWorld extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Mageplaza License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.mageplaza.com/LICENSE.txt
 * 
 *                     @category  Mageplaza
 *                     @package   Mageplaza_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.mageplaza.com/LICENSE.txt
 */
namespace Clagtech\Clagmp\Model\ResourceModel\Clagpost;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * ID Field Name
     * 
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'clagtech_clagmp_clagpost_collection';

    /**
     * Event object
     * 
     * @var string
     */
    protected $_eventObject = 'clagpost_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Clagtech\Clagmp\Model\Clagpost', 'Clagtech\Clagmp\Model\ResourceModel\Clagpost');
    }

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }
    /**
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     */
    protected function _toOptionArray($valueField = 'id', $labelField = 'name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
}
