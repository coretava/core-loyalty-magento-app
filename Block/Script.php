<?php

namespace Coretava\Loyalty\Block;

use Coretava\Loyalty\Helper\Data;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Script extends Template
{
    public Data $helper;

    public function __construct(Context $context, Session $customerSession, Data $helper)
    {
        $this->customerSession = $customerSession;
        $this->customerSession->start();
        $this->helper = $helper;

        parent::__construct($context);
    }

    public function getUser(): array
    {
        $customerId = $this->customerSession->getCustomerId();
        $customerData = $this->customerSession->getCustomer();

        if ($this->helper->isCustomerDataGatheringAllowed()) {
            return array(
                "externalId" => $customerId,
                "email" => $customerData->getEmail(),
                "firstName" => $customerData->getFirstname(),
                "lastName" => $customerData->getLastname(),
                "hash" => hash_hmac('sha256', $this->helper->getAppId() . '|' . $customerData->getEmail(), $this->helper->getAppKey())
            );
        } else {
            return array(
                "externalId" => $customerId,
                "email" => $customerData->getEmail(),
                "hash" => hash_hmac('sha256', $this->helper->getAppId() . '|' . $customerData->getEmail(), $this->helper->getAppKey())
            );
        }
    }
}
