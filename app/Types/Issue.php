<?php

declare(strict_types=1);

namespace App\Types;

readonly class Issue
{
    public int $number;
    public string $title;
    public string $body;

    public IssueType $type;
    public Status $status;

    public array $comments;
}
