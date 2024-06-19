<?php

declare(strict_types=1);

namespace App\Types;

/**
 * The GitHub Issue Type
 */
enum IssueType
{
    /**
     * A classic issue
     */
    case Issue;

    /**
     * A discussion thread
     */
    case Discussion;

    /**
     * A pull request
     */
    case PullRequest;
}
