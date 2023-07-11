<?php
namespace Coretava\Loyalty\Block;
use \Coretava\Loyalty\Helper\Data;

class Script extends \Magento\Framework\View\Element\Template
{
    protected $helper;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Customer\Model\Session $customerSession,
        Data $helper
    )
	{
        $this->customerSession = $customerSession;
        $this->customerSession->start();
        $this->helper = $helper;
		parent::__construct($context);
	}

    public function getAppId() 
    {
        return $this->helper->getAppId();
    }

    public function getUser()
    {
        $customerId = $this->customerSession->getCustomerId();
        $customerData = $this->customerSession->getCustomer();
        
        $user = array(
            "externalId" => $customerId,
            "email" => $customerData->getEmail(),
            "firstName" => $customerData->getFirstname(),
            "lastName" => $customerData->getLastname(),
            "hash" => hash_hmac('sha256', $this->getAppId() . '|' . $customerData->getEmail(), $this->helper->getAppKey())
        );

        return $user;
    }
}