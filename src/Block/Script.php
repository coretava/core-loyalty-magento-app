<?php

namespace Coretava\Loyalty\Block;

use Coretava\Loyalty\Helper\Data;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Script extends Template
{
    protected Data $helper;

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

        return array(
            "externalId" => $customerId,
            "email" => $customerData->getEmail(),
            "firstName" => $customerData->getFirstname(),
            "lastName" => $customerData->getLastname(),
            "hash" => hash_hmac('sha256', $this->getAppId() . '|' . $customerData->getEmail(), $this->helper->getAppKey())
        );
    }

    public function getAppId()
    {
        return $this->helper->getAppId();
    }
}
