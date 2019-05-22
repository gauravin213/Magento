<?php

namespace Clag\Minicartitem\Plugin;

use Magento\Quote\Model\Quote\Item;

class DefaultItem
{

    public function __construct(
        \Magento\Wishlist\Helper\Data $wishlistHelper,
        \Magento\Catalog\Helper\Product\Compare $comparetHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Clag\Minicartitem\Helper\Data $savrForLaterActionUrl
    ) {
        $this->wishlistHelper = $wishlistHelper;
        $this->comparetHelper = $comparetHelper;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->savrForLaterActionUrl = $savrForLaterActionUrl;
    }


    public function aroundGetItemData($subject, \Closure $proceed, Item $item)
    {
        $data = $proceed($item);

        $product = $item->getProduct();

        $wl = "<a href='#' class='action towishlist actions-secondary' title='Add to Wish List' aria-label='Add to Wish List' data-post='".$this->wishlistHelper->getAddParams($product)."'  data-action='add-to-wishlist'>
        </a>";

        $pr = "<button type='button' data-post='".$this->savrForLaterActionUrl->getSaveforlaterActionUrl($product->getId())."' title='Add to Cart'>
                <span>Save for latter</span>
            </button>";

       //$pr = $this->savrForLaterActionUrl->getSaveforlaterActionUrl($product->getId());

        $atts = [
            "custom_code_wishlist" => $wl,
            "custom_code_saveforlatteraction" => $pr

        ];

        return array_merge($data, $atts);
    }
}