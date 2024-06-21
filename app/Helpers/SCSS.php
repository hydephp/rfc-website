<?php

declare(strict_types=1);

namespace App\Helpers;

class SCSS
{
    /**
     * Compile the given SCSS string.
     */
    public function compile(string $scss): string
    {
        //
    }

    /**
     * Compile the given SCSS file in the `resources/scss` directory.
     */
    public function file(string $file): string
    {
        return $this->compile(file_get_contents(resource_path("scss/{$file}.scss")));
    }
}
