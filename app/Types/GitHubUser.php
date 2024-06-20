<?php

declare(strict_types=1);

namespace App\Types;

use Stringable;

readonly class GitHubUser implements Stringable
{
    /** @var string The "login" username */
    public string $username;

    /** @var string The "pretty" name */
    public string $name;

    public function __construct(string $username, string $name)
    {
        $this->username = $username;
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
