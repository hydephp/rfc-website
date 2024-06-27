<?php

declare(strict_types=1);

namespace App\Types;

use App\Helpers\Generics;
use App\Helpers\GitHub;
use DateTimeImmutable;
use Exception;
use Hyde\Framework\Actions\ConvertsMarkdownToPlainText;
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
        $markdown = $this->preprocessSummary($this->body->body());
        $body = (new ConvertsMarkdownToPlainText($markdown))->execute();

        return substr($body, 0, 200).'...';
    }

    protected function preprocessSummary(string $markdown): string
    {
        $lines = explode("\n", trim($markdown));
        // If first line is a heading, remove it
        if (str_starts_with($lines[0], '#')) {
            array_shift($lines);
        }
        $markdown = implode("\n", $lines);

        return trim($markdown);
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
