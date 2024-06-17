<?php

namespace App\Enum;
use ReflectionException;

class Enum
{

    /**
     * getConstants
     *
     * @param  mixed $class
     * @return array
     */
    public static function getConstants($class): array
    {
        $reflectionClass = new \ReflectionClass($class);
        return $reflectionClass->getConstants();
    }
    /**
     * getLocalConstants
     *
     * @return array
     */
    public static function getLocalConstants(): array
    {
        return static::getConstants(static::class);
    }
}
