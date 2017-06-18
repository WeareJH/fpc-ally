<?php

namespace Jh\FpcAlly\Exception;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
class InvalidConfigurationException extends \InvalidArgumentException
{
    public static function missingHandlerClass(string $name, string $handlerClass) : self
    {
        return new self(sprintf(
            'Configuration for "%s" defines class "%s" as the handler which doesn\'t exists',
            $name,
            $handlerClass
        ));
    }
}
