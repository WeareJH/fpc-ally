<?php

namespace Jh\FpcAlly\Api;

/**
 * @author Michael Woodward <michael@wearejh.com>
 */
interface FpcVariationHandlerInterface
{
    /**
     * Provides the variation key, unique to each variation
     *
     * @return string
     */
    public function getVariationKey() : string;

    /**
     * Provides the value for the FPC variation in the current state
     *
     * @return mixed
     */
    public function getVariationValue();

    /**
     * Provides the default value for FPC variation
     *
     * @return mixed
     */
    public function getVariationDefaultValue();
}
