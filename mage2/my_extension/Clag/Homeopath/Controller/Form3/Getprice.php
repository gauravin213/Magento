<?php
namespace Clag\Homeopath\Controller\Form3;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Getprice extends Action
{

    protected $_customerSession;
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Catalog\Model\ProductFactory $Product,
    \Magento\Catalog\Model\CategoryFactory $CategoryFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Catalog\Model\ProductRepository $productRepository,
    \Magento\CatalogInventory\Api\StockStateInterface $stockItem,
     array $data = []
    ) 
    {
        
        $this->Product = $Product;
        $this->CategoryFactory = $CategoryFactory;
        $this->_storeManager = $storeManager;
        $this->productRepository = $productRepository;
        $this->stockItem = $stockItem;
        parent::__construct($context, $data);

    }



    public function execute(){

        $ParamsData = $this->getRequest()->getParams(); 

        $repository = $this->productRepository;
        $product = $repository->getById($ParamsData['productId']);

        $data = $product->getTypeInstance()->getConfigurableOptions($product);

        $options = array();

        foreach($data as $attr){
          foreach($attr as $p){
            $options[$p['sku']][$p['attribute_code']] = $p['option_title'];
          }
        }

        $getPriceArray = array();

        foreach($options as $sku =>$d){
          $pr = $repository->get($sku);
          $new_key='';
          foreach($d as $k => $v){
            if($k==$ParamsData['attributeCodeForm']) { //form
                $new_key = $v;
            }
          }
            
          $getPriceArray[$new_key] = array(
                                        'price'=>$pr->getPrice(), 
                                        'sku'=>$sku
                                    );
            
        }

        $key = $ParamsData['form'];

        if (array_key_exists($key, $getPriceArray)) 
        {
            $_product = $this->productRepository->get($getPriceArray[$key]['sku']);

            $selected_configurable_option = $_product->getId();
            
            $Product_price = number_format($_product->getPrice(),2); 
       
            $Qty = $this->stockItem->getStockQty($_product->getId(), $_product->getStore()->getWebsiteId());
        
            $response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData(['selected_configurable_option'=>$selected_configurable_option,'price'=>$Product_price, 'qty'=>$Qty]);
            return $response;


        }
        else
        {
            $response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData(['result'=>0]);
            return $response;
        }
    }
}