<?php

/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Bannerslider
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

namespace Gaurav\Sharma\Block\Adminhtml\Advertise;

use Gaurav\Sharma\Model\Status;

/**
 * Slider grid.
 * @category Magestore
 * @package  Magestore_Bannerslider
 * @module   Bannerslider
 * @author   Magestore Developer
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * slider collection factory.
     *
     * @var \Magestore\Bannerslider\Model\ResourceModel\Slider\CollectionFactory
     */
    protected $_sliderCollectionFactory;


    /**
     * [__construct description].
     *
     * @param \Magento\Backend\Block\Template\Context                         $context
     * @param \Magento\Backend\Helper\Data                                    $backendHelper
     * @param \Magestore\Bannerslider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory
     * @param \Magestore\Bannerslider\Helper\Data                             $bannersliderHelper
     * @param array                                                           $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Gaurav\Sharma\Model\Resource\Advertise\CollectionFactory $sliderCollectionFactory,
        //\Magestore\Bannerslider\Helper\Data $bannersliderHelper,
        array $data = []
    ) {
        $this->_sliderCollectionFactory = $sliderCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * [_construct description].
     *
     * @return [type] [description]
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('advertiseGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection.
     *
     * @return [type] [description]
     */
    protected function _prepareCollection()
    {
        $collection = $this->_sliderCollectionFactory->create();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'name',
            [
                'header' => __('name'),
                'index' => 'name',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );

        $this->addColumn(
            'url_key',
            [
                'header' => __('url_key'),
                'index' => 'url_key',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );

        $this->addColumn(
            'post_content',
            [
                'header' => __('post_content'),
                'index' => 'post_content',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('status'),
                'index' => 'status',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('created_at'),
                'index' => 'created_at',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );


        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit',
                        ],
                        'field' => 'id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );
        $this->addExportType('*/*/exportCsv', __('CSV')); 
        $this->addExportType('*/*/exportXml', __('XML'));
        $this->addExportType('*/*/exportExcel', __('Excel'));

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        //$statuses = Status::getAvailableStatuses();

        //array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('*/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        //'values' => $statuses,
                        'values' => array(
                            array('value' => '', 'label' => ''), 
                            array('value' => '1', 'label' => 'Enable'), 
                            array('value' => '0', 'label' => 'Disable')
                          )
                    ],
                ],
            ]
        );

        return $this;
    }

    public function getGridUrl()
    {
        //return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * get row url
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        //return $this->getUrl(
            //'*/*/edit',
            //array('id' => $row->getId())
        //);
    }
}
