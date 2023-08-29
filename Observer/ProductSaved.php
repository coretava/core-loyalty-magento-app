<?php

namespace Coretava\Loyalty\Observer;

use \Magento\Framework\Event\ObserverInterface;
use \Magento\Framework\Event\Observer;
use Coretava\Loyalty\Helper\Api;

class ProductSaved implements ObserverInterface
{
    protected Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function execute(Observer $observer): ProductSaved
    {
        $product = $observer->getEvent()->getProduct();

        $this->api->sendProductHookApi(json_encode(array(
            'productId' => $product->getId()
        )));

        return $this;
    }
}
