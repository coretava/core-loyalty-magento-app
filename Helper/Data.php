<?php

namespace Coretava\Loyalty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const ENVIRONMENT = 'staging';
    const XML_PATH_CORETAVA = 'loyalty/general/';
    const APP_ID_FIELD = self::XML_PATH_CORETAVA . "coretava_app_id";
    const APP_KEY_FIELD = self::XML_PATH_CORETAVA . "coretava_app_key";

    public function getAppId()
    {
        return $this->getConfigValue(self::APP_ID_FIELD);
    }

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getAppKey()
    {
        return $this->getConfigValue(self::APP_KEY_FIELD);
    }

    public function getApiDomain(): string
    {
        return match (self::ENVIRONMENT) {
            'dev' => 'https://api.dev.coretava.com',
            'staging' => 'https://api.staging.coretava.com',
            default => 'https://api.coretava.com',
        };
    }

    public function getStaticDomain(): string
    {
        return match (self::ENVIRONMENT) {
            'dev' => 'https://static-dev.gamiphy.co',
            'staging' => 'https://static-static.gamiphy.co',
            default => 'https://static.gamiphy.co',
        };
    }
}
