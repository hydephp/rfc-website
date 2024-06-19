<?php

declare(strict_types=1);

namespace App\Types;

use App\Helpers\Generics;

readonly class Issue
{
    public int $number;
    public string $title;
    public string $body;
    public GitHubUser $author;
    public IssueType $type;
    public Status $status;

    /**
     * @var array<array-key, IssueComment>
     */
    public array $comments;

    public function __construct(int $number, string $title, string $body, GitHubUser $author, IssueType $type, Status $status, array $comments)
    {
        $this->number = $number;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->type = $type;
        $this->status = $status;
        $this->comments = Generics::typeSafeArray($comments, IssueComment::class);
    }
}
