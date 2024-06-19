<?php

declare(strict_types=1);

namespace App\Types;

use DateTimeImmutable;

readonly class IssueComment
{
    public string $author;
    public string $body;

    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;
}
