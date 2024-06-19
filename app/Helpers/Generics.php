<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Helper class for type-safe generics evaluated at runtime.
 */
class Generics
{
    /**
     * Type-safe array where the same array will be returned, once the generics have been asserted.
     *
     * @template T of class-string
     *
     * @param  array<T>  $array
     * @param  T  $type
     * @return array<T>
     */
    public static function typeSafeArray(array $array, string $type): array
    {
        $arrayType = gettype($array);
        if ($arrayType !== 'array') {
            throw new \TypeError("Expected an array, got $arrayType");
        }

        $arrayCopy = $array;
        foreach ($arrayCopy as $value) {
            $valueType = gettype($value);
            if ($valueType !== $type) {
                throw new \TypeError("Expected $type, got $valueType");
            }
        }

        return $array;
    }
}
