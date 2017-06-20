<h1 align="center">FPC Ally</h1>

<p align="center">Abstractions around the FPC functionality for Magento 2.</p>

## Install

```
$ composer config repositories.m2-unit-test-helpers vcs git@github.com:WeareJH/fpc-ally.git
$ composer require wearejh/m2-module-fpc-ally
```

## Usage

### FPC Variations

To add FPC variations Magento has a HTTP Context class that is used to create a “Vary” string. This is sent as a cookie to the user for future requests. Varnish will read this cookie and use it as part of it’s hashing to find/save cache records. Magento actually vary the cache by a few things by default, e.g. currency, logged in/out, customer group etc.

To add a new variation create a new file `fpc_variations.xml` in your `etc` directory which defines the variations you want and their respective handlers, e.g.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Jh_FpcAlly:etc/fpc_variations.xsd">
    <fpc_variation name="tax_display" handler="Vendor\VatSwitch\FpcVariation\Handler" />
</config>
```

Your handler should implement `\Jh\FpcAlly\Api\FpcVariationHandlerInterface` where you can provide the logic behind what drives the variation, e.g. the state of a VAT switch on the session 

__NOTE:__ This feature should be used sparingly as too many variations will effectively multiply the amount of caches possible for each page, resulting in a much higher cache MISS rate. 
