<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

// @codingStandardsIgnoreFile

namespace Gaurav\Sharma\Block\Adminhtml\Advertise\Edit\Tab;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;



class Main extends Generic implements TabInterface
{

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Advertise Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Advertise Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_gaurav_sharma_advertise');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('advertise');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Advertise Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Advertise Name'), 'title' => __('Advertise Name'), 'required' => true]
        );
        $fieldset->addField(
            'url_key',
            'text',
            ['name' => 'url_key', 'label' => __('url_key'), 'title' => __('url_key'), 'required' => true]
        );
        /*$fieldset->addField(
            'post_content',
            'text',
            ['name' => 'post_content', 'label' => __('post_content'), 'title' => __('post_content'), 'required' => true]
        );*/

        $fieldset->addField(
            'post_content',
            'editor',
            [
                'name' => 'post_content',
                'label' => __('post_content'),
                'title' => __('post_content'),
                'wysiwyg' => true,
                'required' => false,
            ]
        );

        $fieldset->addField(
            'status',
            'text',
            ['name' => 'status', 'label' => __('status'), 'title' => __('status'), 'required' => true]
        );
        $fieldset->addField(
            'created_at',
            'text',
            ['name' => 'created_at', 'label' => __('created_at'), 'title' => __('created_at'), 'required' => true]
        );
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
