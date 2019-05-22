<?php

namespace Clagtech\Clagmp\Ui\Component\Listing\Column;

class Statuscolumn extends \Magento\Ui\Component\Listing\Columns\Column {

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {

                
                
                
                $item['statuscolumn'] = $item['status']; 
                 //var_dump($item);

            }
        }

        //die();
        return $dataSource;

    }
}