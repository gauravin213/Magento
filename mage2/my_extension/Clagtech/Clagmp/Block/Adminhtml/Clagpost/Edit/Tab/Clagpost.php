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
namespace Clagtech\Clagmp\Block\Adminhtml\Clagpost\Edit\Tab;

class Clagpost extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Wysiwyg config
     * 
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * Country options
     * 
     * @var \Magento\Config\Model\Config\Source\Locale\Country
     */
    protected $_countryOptions;

    /**
     * Country options
     * 
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    protected $_booleanOptions;

    /**
     * Sample Multiselect options
     * 
     * @var \Mageplaza\HelloWorld\Model\Post\Source\SampleMultiselect
     */
    protected $_sampleMultiselectOptions;

    /**
     * constructor
     * 
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Config\Model\Config\Source\Locale\Country $countryOptions
     * @param \Magento\Config\Model\Config\Source\Yesno $booleanOptions
     * @param \Mageplaza\HelloWorld\Model\Post\Source\SampleMultiselect $sampleMultiselectOptions
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Config\Model\Config\Source\Locale\Country $countryOptions,
        \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
        \Clagtech\Clagmp\Model\Clagpost\Source\SampleMultiselect $sampleMultiselectOptions,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {
        $this->_wysiwygConfig            = $wysiwygConfig;
        $this->_countryOptions           = $countryOptions;
        $this->_booleanOptions           = $booleanOptions;
        $this->_sampleMultiselectOptions = $sampleMultiselectOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Mageplaza\HelloWorld\Model\Post $post */
        $post = $this->_coreRegistry->registry('clagtech_clagmp_clagpost');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('post_');
        $form->setFieldNameSuffix('post');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Post Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        $fieldset->addType('image', 'Clagtech\Clagmp\Block\Adminhtml\Clagpost\Helper\Image');
        $fieldset->addType('file', 'Clagtech\Clagmp\Block\Adminhtml\Clagpost\Helper\File');
        if ($post->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'  => 'title',
                'label' => __('title'),
                'title' => __('title'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'undertitle',
            'text',
            [
                'name'  => 'undertitle',
                'label' => __('Undertitle'),
                'title' => __('Undertitle'),
            ]
        );
        $fieldset->addField(
            'description',
            'editor',
            [
                'name'  => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'config'    => $this->_wysiwygConfig->getConfig()
            ]
        );
       /* $fieldset->addField(
            'tags',
            'text',
            [
                'name'  => 'tags',
                'label' => __('Tags'),
                'title' => __('Tags'),
            ]
        );*/
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                //'values' => $this->_booleanOptions->toOptionArray(),
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')],
            ]
        );
        $fieldset->addField(
            'trash',
            'select',
            [
                'name'  => 'trash',
                'label' => __('Trash'),
                'title' => __('Trash'),
                //'values' => $this->_booleanOptions->toOptionArray(),
                'options' => ['1' => __('Active'), '0' => __('Trash')],
            ]
        );
        $fieldset->addField(
            'featured_image',
            'file',
            [
                'name'  => 'featured_image',
                'label' => __('Featured Image'),
                'title' => __('Featured Image'),
            ]
        );
        /*$fieldset->addField(
            'sample_country_selection',
            'select',
            [
                'name'  => 'sample_country_selection',
                'label' => __('Sample Country Selection'),
                'title' => __('Sample Country Selection'),
                'values' => array_merge(['' => ''], $this->_countryOptions->toOptionArray()),
            ]
        );*/
        $fieldset->addField(
            'sample_upload_file',
            'file',
            [
                'name'  => 'sample_upload_file',
                'label' => __('Sample File'),
                'title' => __('Sample File'),
            ]
        );
        /*$fieldset->addField(
            'sample_multiselect',
            'multiselect',
            [
                'name'  => 'sample_multiselect',
                'label' => __('Sample Multiselect'),
                'title' => __('Sample Multiselect'),
                'values' => $this->_sampleMultiselectOptions->toOptionArray(),
            ]
        );*/

        $postData = $this->_session->getData('clagtech_clagmp_clagpost_data', true);
        if ($postData) {
            $post->addData($postData);
        } else {
            if (!$post->getId()) {
                $post->addData($post->getDefaultValues());
            }
        }
        $form->addValues($post->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Post');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
