<?php

declare(strict_types=1);

namespace App\Types;

use App\Helpers\Generics;
use Illuminate\Support\Collection;

class IssueList
{
    /**
     * @var array<array-key, Issue>
     */
    protected array $issues;

    /**
     * Create a new IssueList object from an array of Issue objects.
     *
     * @param  array<array-key, Issue>  $issues
     */
    public function __construct(array $issues)
    {
        $this->issues = Generics::typeSafeArray($issues, Issue::class);
    }

    /**
     * Get the list of issues.
     *
     * @return \Illuminate\Support\Collection<array-key, Issue>
     */
    public function issues(): Collection
    {
        return collect($this->issues);
    }
}
