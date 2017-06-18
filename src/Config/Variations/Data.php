<?php

namespace Jh\FpcAlly\Config\Variations;

use Illuminate\Support\Collection;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Config\Data as ConfigData;
use Magento\Framework\Config\ReaderInterface;
use Magento\Framework\Config\CacheInterface;
use Magento\Framework\ObjectManagerInterface;
use Jh\FpcAlly\Api\FpcVariationHandlerInterface;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class Data extends ConfigData
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(
        ObjectManagerInterface $objectManager,
        ReaderInterface $reader,
        CacheInterface $cache,
        $cacheId
    ) {
        $this->objectManager = $objectManager;
        parent::__construct($reader, $cache, $cacheId);
    }

    /**
     * @return FpcVariationHandlerInterface[]
     */
    public function getHandlers() : array
    {
        return Collection::make($this->_data)
            ->map(function ($handlerConfig) {
                return $this->objectManager->get($handlerConfig['handler']);
            })
            ->toArray();
    }
}
