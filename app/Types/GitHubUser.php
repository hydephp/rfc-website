<?php

declare(strict_types=1);

namespace App\Types;

use Stringable;

readonly class GitHubUser implements Stringable
{
    /** @var string The "login" username */
    public string $username;

    public function __construct(string $name)
    {
        $this->username = $name;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
