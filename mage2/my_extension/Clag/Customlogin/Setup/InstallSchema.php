<?php

namespace Clag\Customlogin\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * Upgrade data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.1', '<')) {
            $this->createMobileAttribute($setup);
        }
    }

    public function createMobileAttribute($setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        // Add new customer attribute
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'phone',
            [

                'label'                 => 'Phone',
                'input'                 => 'text',
                'required'              => false,
                'sort_order'            => 1000,
                'position'              => 1000,
                'visible'               => true,
                'system'                => false,
                'is_used_in_grid'       => true,
                'is_visible_in_grid'    => false,
                'is_filterable_in_grid' => false,
                'is_searchable_in_grid' => false,
                'default'               => ''
            ]
        );

        // add attribute to form
        /** @var  $attribute */
        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'phone');
        $attribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_create', 'customer_account_edit']);
        $attribute->save();

        $setup->endSetup();
    }
}
?>