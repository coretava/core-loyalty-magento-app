<?php

namespace Coretava\Loyalty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CORETAVA = 'coretava_core_loyalty/general/';
    const APP_ID_FIELD = self::XML_PATH_CORETAVA . "app_id";
    const APP_KEY_FIELD = self::XML_PATH_CORETAVA . "app_key";
    const CUSTOMER_DATA_GATHERING = self::XML_PATH_CORETAVA . "allow_customer_data_gathering";

    private function getConfigValue($field)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE);
    }

    public function getAppId(): string
    {
        return $this->getConfigValue(self::APP_ID_FIELD);
    }

    public function getAppKey(): string
    {
        return $this->getConfigValue(self::APP_KEY_FIELD);
    }

    public function isCustomerDataGatheringAllowed(): bool
    {
        return $this->getConfigValue(self::CUSTOMER_DATA_GATHERING) == 'yes';
    }

    public function getEnvironment(): string
    {
        $storeName = $this->getConfigValue('general/store_information/name');

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
