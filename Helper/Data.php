<?php

namespace Coretava\Loyalty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CORETAVA = 'loyalty/general/';
    const APP_ID_FIELD = self::XML_PATH_CORETAVA . "coretava_app_id";
    const APP_KEY_FIELD = self::XML_PATH_CORETAVA . "coretava_app_key";

    public function getAppId()
    {
        return $this->getConfigValue(self::APP_ID_FIELD);
    }

    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE);
    }

    public function getAppKey()
    {
        return $this->getConfigValue(self::APP_KEY_FIELD);
    }

    public function getEnvironment(): string
    {
        $storeName = $this->scopeConfig->getValue('general/store_information/name', ScopeInterface::SCOPE_STORE);

        if (stripos($storeName, 'coretava_dev') !== false) {
            return 'dev';
        }

        if (stripos($storeName, 'coretava_staging') !== false) {
            return 'staging';
        }

        return 'prod';
    }

    public function getApiDomain(): string
    {
        switch ($this->getEnvironment()) {
            case 'dev':
                return 'https://api.dev.coretava.com';
            case 'staging':
                return 'https://api.staging.coretava.com';
            default:
                return 'https://api.coretava.com';
        }
    }

    public function getStaticDomain(): string
    {
        switch ($this->getEnvironment()) {
            case 'dev':
                return 'https://static-dev.gamiphy.co';
            case 'staging':
                return 'https://static-staging.gamiphy.co';
            default:
                return 'https://static.gamiphy.co';
        }
    }
}
