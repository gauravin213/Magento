<?php
namespace Clag\Customlogin\Block\Tabs;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Cancelorder extends \Magento\Framework\View\Element\Template
{
   protected $_customerSession;

    protected $_customerSessionFactory;

    protected $_catalogSession;

    //protected $_productFactory;

    protected $_messageManager;

    //protected $_storeManagerInterface;

    protected $_priceCurrency;

    protected $_orderCollectionFactory;

    protected $_orderConfig;

    public function __construct
    (
    Context $context,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Customer\Model\SessionFactory $customerSessionFactory,
    \Magento\Catalog\Model\Session $catalogSession,
    \Magento\Catalog\Model\ProductFactory $productFactory,
    \Magento\Framework\Message\ManagerInterface $messageManager,
    \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
    \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
    \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
    \Magento\Sales\Model\Order\Config $orderConfig,
    array $data = []
    )
    {
        $this->_customerSession = $customerSession;
        $this->_customerSessionFactory = $customerSessionFactory;
        $this->_catalogSession = $catalogSession;
        $this->_productFactory = $productFactory;
        $this->_messageManager = $messageManager;
        $this->_storeManagerInterface = $storeManagerInterface;
        $this->_priceCurrency = $priceCurrency;

        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_orderConfig = $orderConfig;

        parent::__construct($context, $data);
    }

    /**
     * Get current currency code
     *
     * @return string
    */ 
    public function getCurrentCurrencyCode(){
      return $this->_priceCurrency->getCurrency()->getCurrencyCode();
    }

    /**
     * Get current currency symbol
     *
     * @return string
     */ 
    public function getCurrentCurrencySymbol(){
      return $this->_priceCurrency->getCurrency()->getCurrencySymbol();
    }

    public function getPlaceholderImage(){
       
        return sprintf('<img src="%s"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg'));
    }

    /**
    * Get getCustomerId
    *
    * @return string
    */ 
    public function getCustomerId(){
        $customer = $this->_customerSessionFactory->create();
        return $customer->getCustomer()->getId();
    }

    
    /*
    * Get Current Orders
    */
    public function getCurrentOrdersCollection(){

        $customerId = $this->getCustomerId();
        $collection = $this->_orderCollectionFactory->create($customerId);
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('status', ['in' => 'canceled']);
        $collection->setOrder('created_at', 'desc');

        return $collection;
    }

    /**
    * PrepareLayout
    *
    * @return string
    */
    protected function _prepareLayout()
    {

        /**/
        /*$product = $this->_productFactory->create()->load(41);

        echo "==>".$product->getName();*/
        /**/


        parent::_prepareLayout();
        if ($this->getCurrentOrdersCollection()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'sales.order.history.pager'
            )->setCollection(
                $this->getCurrentOrdersCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCurrentOrdersCollection()->load();
        }
        return $this;
    }

    /**
    * Get PagerHtml
    * @return string
    */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @param object $order
     * @return string
     */
    public function getViewUrl($order)
    {
        return $this->getUrl('sales/order/view', ['order_id' => $order->getId()]);
    }

    /**
     * @param object $order
     * @return string
     */
    public function getTrackUrl($order)
    {
        return $this->getUrl('sales/order/track', ['order_id' => $order->getId()]);
    }

    /**
     * @param object $order
     * @return string
     */
    public function getReorderUrl($order)
    {
        return $this->getUrl('sales/order/reorder', ['order_id' => $order->getId()]);
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/');
    }
}