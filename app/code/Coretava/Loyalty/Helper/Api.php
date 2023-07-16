<?php

namespace Coretava\Loyalty\Helper;
class Api extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getBaseDomain()
    {
        return "https://coretava.requestcatcher.com/test";
    }

    public function sendApiRequest($vars) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->getBaseDomain());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headersForCurl);
        curl_exec($ch);
        curl_close($ch);
    }
}
