<?php

declare(strict_types=1);

namespace App\Types;

use App\Helpers\Generics;
use DateTimeImmutable;
use Hyde\Markdown\Models\Markdown;

/**
 * Represent a GitHub Issue, which can be an Issue or a Pull Request.
 *
 * @property string $created
 * @property string $updated
 */
readonly class Issue
{
    protected final const string DATE_FORMAT = 'Y-m-d H:i:s';

    public int $number;
    public string $title;
    public Markdown $body;
    public GitHubUser $author;
    public IssueType $type;
    public Status $status;
    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;

    /**
     * @var array<array-key, IssueComment>
     */
    public array $comments;

    /**
     * Create a new Issue object.
     *
     * @param  array<array-key, IssueComment>  $comments
     */
    public function __construct(int $number, string $title, Markdown $body, GitHubUser $author, IssueType $type, Status $status, array $comments, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt)
    {
        $this->number = $number;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->type = $type;
        $this->status = $status;
        $this->comments = Generics::typeSafeArray($comments, IssueComment::class);
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function __get(string $name)
    {
        if ($name === 'created') {
            return $this->createdAt->format(self::DATE_FORMAT);
        }

        if ($name === 'updated') {
            return $this->updatedAt->format(self::DATE_FORMAT);
        }

        if ($name === 'prettyTitle') {
            return $this->prettyTitle();
        }

        return null;
    }

    protected function prettyTitle(): string
    {
        return sprintf('%s (#%d)', $this->title, $this->number);
    }
}
