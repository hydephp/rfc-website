<?php

declare(strict_types=1);

namespace App\Helpers;

// See https://github.com/panique/laravel-sass for caching and optimization ideas
use ScssPhp\ScssPhp\Compiler;

class SCSS
{
    /**
     * Compile the given SCSS string.
     */
    public function compile(string $scss): string
    {
        $compiler = new Compiler();

        return $compiler->compileString($scss)->getCss();
    }

    /**
     * Compile the given SCSS file in the `resources/scss` directory.
     */
    public function file(string $file): string
    {
        $file = basename($file, '.scss');

        return $this->compile(file_get_contents(resource_path("scss/{$file}.scss")));
    }
}
