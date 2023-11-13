<?php

namespace Coretava\Loyalty\Observer;

use Coretava\Loyalty\Helper\Api;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductDeleted implements ObserverInterface
{
    protected Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function execute(Observer $observer): ProductDeleted
    {
        $product = $observer->getEvent()->getProduct();

        $this->api->sendProductHookApi(json_encode(array(
            'productId' => $product->getId()
        )));

        return $this;
    }
}
