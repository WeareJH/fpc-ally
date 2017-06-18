<?php

namespace Jh\FpcAlly\Config\Variations;

use Illuminate\Support\Collection;
use Magento\Framework\Config\ConverterInterface;
use Jh\FpcAlly\Exception\InvalidConfigurationException;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class Converter implements ConverterInterface
{
    /**
     * {@inheritdoc}
     * @throws InvalidConfigurationException When handler class does not exist
     */
    public function convert($source)
    {
        return Collection::make($source->getElementsByTagName('fpc_variation'))
            ->map(function (\DomNode $node) {
                return [
                    'name'    => $node->attributes->getNamedItem('name')->nodeValue,
                    'handler' => $node->attributes->getNamedItem('handler')->nodeValue,
                ];
            })
            ->each(function ($handlerConfig) {
                if (!class_exists($handlerConfig['handler'])) {
                    throw InvalidConfigurationException::missingHandlerClass(
                        $handlerConfig['name'],
                        $handlerConfig['handler']
                    );
                }
            })
            ->toArray();
    }
}
