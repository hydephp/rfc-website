<?php

declare(strict_types=1);

namespace App\Helpers;

use TypeError;

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
     *
     * @throws \TypeError
     */
    public static function typeSafeArray(array $array, string $type): array
    {
        foreach ($array as $item) {
            if (! is_a($item, $type)) {
                throw new TypeError(sprintf("Expected an array of '%s', but got an array of '%s'", $type, get_class($item)));
            }
        }

        return $array;
    }
}
