<?php

declare(strict_types=1);

namespace App\Types;

use Illuminate\Contracts\Support\Htmlable;

/**
 * The GitHub Issue Type
 */
enum IssueType implements Htmlable
{
    /**
     * A classic issue
     */
    case Issue;

    /**
     * A pull request
     */
    case PullRequest;

    public function toHtml(): string
    {
        return match ($this) {
            self::Issue => 'Issue',
            self::PullRequest => 'Pull Request',
        };
    }
}
