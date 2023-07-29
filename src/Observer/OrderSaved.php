<?php

namespace Coretava\Loyalty\Observer;

use \Magento\Framework\Event\ObserverInterface;
use \Magento\Framework\Event\Observer;
use Coretava\Loyalty\Helper\Api;

class OrderSaved implements ObserverInterface
{
    protected Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function execute(Observer $observer): static
    {
        $order = $observer->getEvent()->getOrder();

        if ($order->getState() == 'complete') {

            $body = json_encode(array(
                'orderId' => $order->getIncrementId(),
                'status' => $order->getState()
            ));
            $this->api->sendOrderHookApi($body);
        }

        return $this;
    }
}
