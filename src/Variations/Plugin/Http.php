<?php

namespace Jh\FpcAlly\Variations\Plugin;

use Magento\Framework\App\Http\Context;
use Jh\FpcAlly\Config\Variations\Data;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class Http
{
    /**
     * @var Data
     */
    private $variationsData;

    /**
     * @var Context
     */
    private $httpContext;

    public function __construct(Data $variationsData, Context $httpContext)
    {
        $this->variationsData = $variationsData;
        $this->httpContext    = $httpContext;
    }

    public function beforeSendVary()
    {
        foreach ($this->variationsData->getHandlers() as $variationHandler) {
            $this->httpContext->setValue(
                $variationHandler->getVariationKey(),
                $variationHandler->getVariationValue(),
                $variationHandler->getVariationDefaultValue()
            );
        }
    }
}
