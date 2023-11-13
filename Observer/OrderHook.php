<?php

namespace Coretava\Loyalty\Observer;

use Coretava\Loyalty\Helper\Api;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderHook implements ObserverInterface
{
    protected Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function execute(Observer $observer): OrderHook
    {
        $order = $observer->getEvent()->getOrder();

        $body = json_encode(array(
            'orderId' => $order->getIncrementId(),
            'status' => $order->getState()
        ));
        $this->api->sendOrderHookApi($body);

        return $this;
    }
}
