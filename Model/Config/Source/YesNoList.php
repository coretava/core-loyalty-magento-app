<?php

namespace Coretava\Loyalty\Model\Config\Source;

class YesNoList implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'yes', 'label' => __('Yes')],
            ['value' => 'no', 'label' => __('No')]
        ];
    }
}
