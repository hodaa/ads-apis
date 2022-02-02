<?php
namespace App\Enums;

use ReflectionClass;

class Enum
{
    /**
     * @param bool $include_default
     * @return array
     */
    public static function getConstList(bool $include_default = false)
    {
        $reflected = new ReflectionClass(new static(null));
        $constants = $reflected->getConstants();

        if (!$include_default) {
            unset($constants['__default']);

            return $constants;
        }

        return $constants;
    }

    /**
     * @param bool $include_default
     * @return array
     */
    public static function getValues(bool $include_default = false)
    {
        $reflected = new ReflectionClass(new static(null));
        $constants = $reflected->getConstants();
        if (!$include_default) {
            unset($constants['__default']);
            return array_values($constants);
        }
        return array_values($constants);
    }

    /**
     * @param $value
     * @return string
     */
    public static function getName($value): string
    {
        $constants = array_flip(self::getConstList());
        return strtolower($constants[$value]);
    }

}
