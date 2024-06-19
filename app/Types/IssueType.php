<?php

declare(strict_types=1);

namespace App\Types;

/**
 * The GitHub Issue Type
 */
enum IssueType
{
    case Issue;
    case Discussion;
    case PullRequest;
}
