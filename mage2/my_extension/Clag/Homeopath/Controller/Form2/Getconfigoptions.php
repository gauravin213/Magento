<?php
namespace Clag\Homeopath\Controller\Form2;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Getconfigoptions extends Action
{

    protected $_customerSession;
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Catalog\Model\ProductFactory $Product,
    \Magento\Catalog\Model\CategoryFactory $CategoryFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\ConfigurableProduct\Model\Product\Type\Configurable $Configurable,
     array $data = []
    ) 
    {
        
        $this->Product = $Product;
        $this->CategoryFactory = $CategoryFactory;
        $this->_storeManager = $storeManager;
        $this->Configurable = $Configurable;
        parent::__construct($context, $data);

    }


    public function execute()
    {
        $Paramsdata = $this->getRequest()->getParams(); 

        $product  = $this->Product->create()->load($Paramsdata['productId']);

        $productAttributeOptions = $this->Configurable->getConfigurableAttributesAsArray($product);

        //Get All options
        $alloptArray = array();
        foreach ($productAttributeOptions as $data) {
            $alloptArray[$data['attribute_code']] = $data['values'];
        }

       
        if (array_key_exists($Paramsdata['enhancement'], $alloptArray)) 
        {
            $enhancement = '';
            $form = '';

            foreach ($alloptArray[$Paramsdata['enhancement']] as $values) {
            $enhancement .= '<option value="'.$values['value_index'].'">'.$values['label'].'</option>';
            }

            foreach ($alloptArray[$Paramsdata['form']] as $values) {
                $form .= '<option value="'.$values['value_index'].'">'.$values['label'].'</option>';
            }


            $response = $this->resultFactory
                        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                        ->setData(['enhancement'=>$enhancement, 'form'=>$form]);
            return $response;
        }
        else
        {
            $response = $this->resultFactory
                        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                        ->setData(['result'=>0]);
            return $response;
        }




       



        //die('Getconfigoptions');
    }
}