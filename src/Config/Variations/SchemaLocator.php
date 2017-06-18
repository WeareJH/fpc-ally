<?php

namespace Jh\FpcAlly\Config\Variations;

use Magento\Framework\Config\Dom\UrnResolver;
use Magento\Framework\Config\SchemaLocatorInterface;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class SchemaLocator implements SchemaLocatorInterface
{
    /**
     * @var UrnResolver
    */
    private $urnResolver;

    public function __construct(UrnResolver $urnResolver)
    {
        $this->urnResolver = $urnResolver;
    }

    /**
     * {@inheritdoc}
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function getSchema() : string
    {
        return $this->urnResolver->getRealPath('urn:magento:module:Jh_FpcAlly:etc/fpc_variations.xsd');
    }

    /**
     * {@inheritdoc}
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function getPerFileSchema() : string
    {
        return $this->urnResolver->getRealPath('urn:magento:module:Jh_FpcAlly:etc/fpc_variations.xsd');
    }
}
