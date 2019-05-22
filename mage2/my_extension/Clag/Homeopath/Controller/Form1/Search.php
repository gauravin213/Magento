<?php
namespace Clag\Homeopath\Controller\Form1;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Search extends Action
{

    protected $_customerSession;
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Catalog\Model\ProductFactory $Product,
    \Magento\Catalog\Model\CategoryFactory $CategoryFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
     array $data = []
    ) 
    {
        
        $this->Product = $Product;
        $this->CategoryFactory = $CategoryFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);

    }


    public function execute()
    {

        $paramsData = $this->getRequest()->getParams(); 

        $search_key = $paramsData['keywords'];
        
        $product = $this->Product->create();

        $collection = $product->getCollection();

        $collection->addAttributeToSelect(['name', 'price', 'image']);
        $collection->addAttributeToFilter('name', array('like' => '%'.$search_key.'%'));
        $collection->addAttributeToFilter('type_id', array('eq' => 'configurable'));
        $collection->addAttributeToFilter('attribute_set_id', array('eq' => $paramsData['attributeSetId']));
        $collection->setPageSize(100,1);

        if (count($collection->getData())) 
        {
            
            $baseurl =  $this->_storeManager->getStore(0)->getBaseUrl();

            $searchData = array();
            foreach ($collection as $ids) {
                $subarray = array();
                $product = $this->Product->create()->load($ids['entity_id']);

                $cats = $product->getCategoryIds();
                if(count($cats) ){
                    $firstCategoryId = $cats[0];
                    $_category = $this->CategoryFactory->create()->load($firstCategoryId);
                    $_categoryname = $baseurl.strtolower($_category->getName()).'.html?pid='.$ids['entity_id'];
                }

                $searchData[] = $subarray[] = array(
                    'name' => $product->getName(),
                    'price' => '',
                    'url'=> $product->getProductUrl(),
                    'cat'=> $_categoryname,
                    'product_id'=> $ids['entity_id']
                );
            }

            $response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData($searchData);
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