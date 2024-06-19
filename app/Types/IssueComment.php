<?php

declare(strict_types=1);

namespace App\Types;

use DateTimeImmutable;

readonly class IssueComment
{
    public GitHubUser $author;
    public string $body;

    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;

    public function __construct(GitHubUser $author, string $body, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt) {
        $this->author = $author;
        $this->body = $body;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
