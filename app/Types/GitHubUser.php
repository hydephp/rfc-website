<?php

declare(strict_types=1);

namespace App\Types;

readonly class GitHubUser
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
