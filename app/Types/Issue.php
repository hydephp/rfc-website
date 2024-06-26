<?php

declare(strict_types=1);

namespace App\Types;

use App\Actions\FormatsRFCTitle;
use App\Helpers\Generics;
use App\Helpers\GitHub;
use DateTimeImmutable;
use Exception;
use App\Actions\FormatsRFCSummary;
use Hyde\Markdown\Models\Markdown;
use Hyde\Support\Models\Route;

/**
 * Represent a GitHub Issue, which can be an Issue or a Pull Request.
 *
 * @property string $created
 * @property string $updated
 * @property string $prettyTitle
 * @property Route $link
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
        return match ($name) {
            'created' => $this->createdAt->format(self::DATE_FORMAT),
            'updated' => $this->updatedAt->format(self::DATE_FORMAT),
            'prettyTitle' => FormatsRFCTitle::handle($this->number, $this->title),
            'link' => $this->link(),
            default => throw new Exception("Property '$name' does not exist in class ".__CLASS__),
        };
    }

    /**
     * Get the GitHub URL for this issue.
     */
    public function github(): string
    {
        $path = match ($this->type) {
            IssueType::PullRequest => 'pull',
            IssueType::Issue => 'issues',
        };

        $repository = GitHub::REPOSITORY;

        return "https://github.com/$repository/$path/$this->number";
    }

    public function summary(): string
    {
        return FormatsRFCSummary::handle($this->body->body());
    }

    protected function link(): Route
    {
        return route("rfc/$this->number");
    }
}
