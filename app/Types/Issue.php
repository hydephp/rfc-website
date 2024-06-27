<?php

declare(strict_types=1);

namespace App\Types;

use Exception;
use App\Helpers\GitHub;
use App\Helpers\Generics;
use DateTimeImmutable;
use Hyde\Support\Models\Route;
use Hyde\Markdown\Models\Markdown;

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
    protected final const string TITLE_FORMAT = 'RFC %d: %s';

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

        if ($name === 'link') {
            return $this->link();
        }

        throw new Exception("Property '$name' does not exist in class ".__CLASS__);
    }

    /**
     * Get the GitHub URL for this issue.
     */
    public function github(): string
    {
        $path = ($this->type === IssueType::PullRequest) ? 'pull' : 'issues';

        return 'https://github.com/'.GitHub::REPOSITORY.'/'.$path.'/'.$this->number;
    }

    public function summary(): string
    {
        return substr($this->body->body(), 0, 200).'...';
    }

    protected function prettyTitle(): string
    {
        return sprintf(self::TITLE_FORMAT, $this->number, $this->trimTitleAffixes());
    }

    protected function link(): Route
    {
         return route("rfc/$this->number");
    }

    private function trimTitleAffixes(): string
    {
        $title = $this->title;

        if (str_starts_with($title, 'RFC')) {
            $title = substr($title, 3);
        }

        if (str_ends_with($title, 'RFC')) {
            $title = substr($title, 0, -3);
        }

        if (str_ends_with($title, '(RFC)')) {
            $title = substr($title, 0, -5);
        }

        return trim($title, ' :');
    }
}
