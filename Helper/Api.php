<?php

namespace Coretava\Loyalty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Api extends AbstractHelper
{
    protected Data $helper;

    public function __construct(
        Context $context,
        Data    $helper
    )
    {
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function sendOrderHookApi($body): void
    {
        $app_id = $this->helper->getAppId();

        if ($app_id) {
            $this->sendApiRequest('/v2/orders/apps/' . $app_id . '/hooks', $body);
        }
    }

    public function sendProductHookApi($body): void
    {
        $app_id = $this->helper->getAppId();

        if ($app_id) {
            $this->sendApiRequest('/v2/products/apps/' . $app_id . '/hooks', $body);
        }
    }

    public function sendApiRequest($path, $body): void
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->helper->getApiDomain() . $path);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [];

        if ($this->helper->getAppKey()) {
            $headers['Coretava-Signature'] = hash_hmac(
                "sha512",
                $body,
                $this->helper->getAppKey()
            );
        }
        $headers['Content-Type'] = 'application/json';

        $headersForCurl = [];

        foreach ($headers as $key => $header) {
            $headersForCurl[] = $key . ":" . $header;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headersForCurl);
        curl_exec($ch);
        curl_close($ch);
    }
}
