<?php

declare(strict_types=1);

namespace App;

use Hyde\Hyde;
use App\Types\Issue;
use App\Types\Status;
use DateTimeImmutable;
use App\Helpers\GitHub;
use App\Types\IssueType;
use App\Types\IssueList;
use App\Types\GitHubUser;
use Illuminate\Support\Arr;
use Hyde\Pages\MarkdownPage;
use Hyde\Markdown\Models\Markdown;

class RFCService
{
    protected IssueList $rfcs;

    public function handle(): void
    {
        $this->rfcs = $this->getRfcListFromGitHub();

        $this->generateRfcPages();
    }

    protected function getRfcListFromGitHub(): IssueList
    {
        $issues = GitHub::search(['label:RFC', 'is:issue']);
        $pulls = GitHub::search(['label:RFC', 'is:pr']);
        // $discussions = GitHub::rawSearch('repo%3Ahydephp%2Fdevelop+rfc&type=discussions');

        $issues = Arr::map($issues['items'], function (array $issue): Issue {
            return new Issue(
                $issue['number'],
                $issue['title'],
                new Markdown($issue['body']),
                new GitHubUser($issue['user']['login']),
                IssueType::Issue,
                Status::Draft, // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($issue['created_at']),
                new DateTimeImmutable($issue['updated_at']),
            );
        });

        $pulls = Arr::map($pulls['items'], function (array $pull): Issue {
            return new Issue(
                $pull['number'],
                $pull['title'],
                new Markdown($pull['body'] ?? ''),
                new GitHubUser($pull['user']['login']),
                IssueType::PullRequest,
                Status::Draft, // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($pull['created_at']),
                new DateTimeImmutable($pull['updated_at']),
            );
        });

        return new IssueList([...$issues, ...$pulls]);
    }

    public function getItems(): IssueList
    {
        return $this->rfcs;
    }

    protected function generateRfcPages(): void
    {
        $this->rfcs->issues()->each(function (Issue $issue): void {
            $page = new MarkdownPage("rfc/$issue->number");
            Hyde::routes()->addRoute($page->getRoute());
        });
    }
}
