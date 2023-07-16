<?php

namespace Coretava\Loyalty\Observer;

class OrderPaid implements \Magento\Framework\Event\ObserverInterface
{
    protected $logger;
    protected $api;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Coretava\Loyalty\Helper\Api $api
    )
    {
        $this->logger = $logger;
        $this->api = $api;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order\Invoice $invoice */
        $invoice = $observer->getEvent()->getInvoice();
        $order = $invoice->getOrder();
        $incrementId = $order->getIncrementId();

        $this->logger->info("sales_order_invoice_pay Triggered" . $incrementId);
        $this->logger->info(json_encode($incrementId));
        $this->api->sendApiRequest($incrementId);

        return $this;
    }
}
