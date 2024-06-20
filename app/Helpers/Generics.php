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
     * @throws \TypeError
     *
     * @param  array<T>  $array
     * @param  T  $type
     * @return array<T>
     */
    public static function typeSafeArray(array $array, string $type): array
    {
        foreach ($array as $item) {
            if (! is_a($item, $type)) {
                throw new TypeError("Expected an array of {$type}, but got an array of " . get_class($item));
            }
        }

        return $array;
    }
}
