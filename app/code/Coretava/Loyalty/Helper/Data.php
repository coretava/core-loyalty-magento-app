<?php

namespace Coretava\Loyalty\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CORETAVA = 'loyalty/general/';

    const APP_ID_FIELD = self::XML_PATH_CORETAVA . "coretava_app_id";
    const APP_KEY_FIELD = self::XML_PATH_CORETAVA . "coretava_app_key";

    public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}

    public function getAppId() {
        return $this->getConfigValue(self::APP_ID_FIELD);
    }

    public function getAppKey() {
        return $this->getConfigValue(self::APP_KEY_FIELD);
    }

    public function getApiDomain() {
        return "https://api.dev.coretava.com";
    }
}
