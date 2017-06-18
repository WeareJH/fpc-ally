<?php

namespace Jh\FpcAlly\Variations\Plugin;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Http\Context;
use Magento\Framework\App\Request\Http;
use Jh\FpcAlly\Config\Variations\Data;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class Action
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

    public function aroundDispatch(ActionInterface $subject, callable $proceed, Http $request)
    {
        foreach ($this->variationsData->getHandlers() as $variationHandler) {
            $this->httpContext->setValue(
                $variationHandler->getVariationKey(),
                $variationHandler->getVariationValue(),
                $variationHandler->getVariationDefaultValue()
            );
        }
        
        return $proceed($request);
    }
}
